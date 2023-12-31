<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReservationRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Models\Room;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reservation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservations = Reservation::with(['room', 'created_by'])->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        abort_if(Gate::denies('reservation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rooms = Room::pluck('room_info', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.reservations.create', compact('rooms'));
    }

    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create($request->all());

        return redirect()->route('admin.reservations.index');
    }

    public function edit(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rooms = Room::pluck('room_info', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reservation->load('room', 'created_by');

        return view('admin.reservations.edit', compact('reservation', 'rooms'));
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->update($request->all());

        return redirect()->route('admin.reservations.index');
    }

    public function show(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservation->load('room', 'created_by', 'payment');

        return view('admin.reservations.show', compact('reservation'));
    }

    public function destroy(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservation->delete();

        return back();
    }

    public function massDestroy(MassDestroyReservationRequest $request)
    {
        $reservations = Reservation::find(request('ids'));

        foreach ($reservations as $reservation) {
            $reservation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
