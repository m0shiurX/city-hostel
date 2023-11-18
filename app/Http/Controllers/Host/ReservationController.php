<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReservationRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reservation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = Auth::user();

        $reservations = Reservation::whereHas('room', function ($query) use ($user) {
            $query->where('created_by_id', $user->id);
        })->get();

        return view('host.reservations.index', compact('reservations'));
    }

    // Not required
    public function create()
    {
        abort_if(Gate::denies('reservation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rooms = Room::pluck('room_info', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('host.reservations.create', compact('rooms'));
    }

    // Not required
    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create($request->all());

        return redirect()->route('host.reservations.index');
    }

    public function edit(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rooms = Room::pluck('room_info', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reservation->load('room', 'created_by');

        return view('host.reservations.edit', compact('reservation', 'rooms'));
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {

        $reservation->update($request->all());
        if ($request->status == 'approved') {
            $reservation->room->update(['status' => 'booked']);
        }

        if ($request->status == 'cancelled') {
            $reservation->room->update(['status' => 'available']);
        }

        return redirect()->route('host.reservations.index');
    }

    public function show(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservation->load('room', 'created_by');

        return view('host.reservations.show', compact('reservation'));
    }


    public function destroy(Reservation $reservation)
    {
        abort_if(Gate::denies('reservation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reservation->delete();

        return back();
    }

    // Not required
    public function massDestroy(MassDestroyReservationRequest $request)
    {
        $reservations = Reservation::find(request('ids'));

        foreach ($reservations as $reservation) {
            $reservation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
