<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPaymentRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use App\Models\Reservation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payments = Payment::with(['reservation', 'created_by'])->get();

        return view('host.payments.index', compact('payments'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $reservations = Reservation::pluck('room_id', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('host.payments.create');
    }

    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create($request->all());

        return redirect()->route('host.payments.index');
    }

    public function edit(Payment $payment)
    {
        abort_if(Gate::denies('payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservations = Reservation::pluck('room_id', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment->load('reservation', 'created_by');

        return view('host.payments.edit', compact('payment', 'reservations'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->all());

        return redirect()->route('host.payments.index');
    }

    public function show(Payment $payment)
    {
        abort_if(Gate::denies('payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment->load('created_by', 'reservation');

        return view('host.payments.show', compact('payment'));
    }

    public function destroy(Payment $payment)
    {
        abort_if(Gate::denies('payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment->delete();

        return back();
    }

    public function approve(Payment $payment)
    {
        if (auth()->user()->id === $payment->reservation()->room()->created_by_id) {

            $payment->update(['status' => 'approved']);

            return redirect()->back()->with('success', 'Payment approved successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to approve this reservation.');
    }

    public function massDestroy(MassDestroyPaymentRequest $request)
    {
        $payments = Payment::find(request('ids'));

        foreach ($payments as $payment) {
            $payment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
