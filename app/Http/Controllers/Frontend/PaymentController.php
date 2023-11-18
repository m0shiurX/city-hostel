<?php

namespace App\Http\Controllers\Frontend;

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

        $payments = Payment::with(['reservation', 'created_by'])->where('created_by_id', '=', auth()->user()->id)->get();

        return view('frontend.payments.index', compact('payments'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->has('reservation_id')) {
            $reservationId = $request->input('reservation_id');
            // Retrieve the reservation
            $reservation = Reservation::find($reservationId);
            $roomPrice = $reservation->room->price;
            // Check if the reservation exists and was created by the currently authenticated user
            if ($reservation && $reservation->created_by_id === auth()->user()->id) {
                return view('frontend.payments.create', ['reservationId' => $reservationId, 'room_price' => $roomPrice]);
            }
        }
        return redirect()->route('home')->with('error', 'Invalid reservation or unauthorized access.');
    }

    public function store(StorePaymentRequest $request)
    {

        $request->merge(['created_by_id' => auth()->user()->id]);
        Payment::create($request->all());
        Reservation::whereId($request->reservation_id)->update(['status' => 'pending']);

        return redirect()->route('frontend.payments.index');
    }

    public function edit(Payment $payment)
    {
        abort_if(Gate::denies('payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if($payment->created_by_id !== auth()->user()->id, Response::HTTP_FORBIDDEN, '403 Forbidden');
        $reservations = Reservation::where('created_by_id', auth()->id())->pluck('id')->prepend(trans('global.pleaseSelect'), '');
        $payment->load('created_by');

        return view('frontend.payments.edit', compact('payment', 'reservations'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->all());

        return redirect()->route('frontend.payments.index');
    }

    public function show(Payment $payment)
    {
        abort_if(Gate::denies('payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if($payment->created_by_id !== auth()->user()->id, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment->load('reservation', 'created_by');

        return view('frontend.payments.show', compact('payment'));
    }

    public function destroy(Payment $payment)
    {
        abort_if(Gate::denies('payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if($payment->created_by_id !== auth()->user()->id, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment->delete();

        return back();
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
