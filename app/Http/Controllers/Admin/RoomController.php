<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRoomRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Facility;
use App\Models\Hostel;
use App\Models\Room;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RoomController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('room_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rooms = Room::with(['hostel', 'facilities', 'created_by', 'media'])->get();

        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        abort_if(Gate::denies('room_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostels = Hostel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilities = Facility::pluck('name', 'id');

        return view('admin.rooms.create', compact('facilities', 'hostels'));
    }

    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->all());
        $room->facilities()->sync($request->input('facilities', []));
        foreach ($request->input('images', []) as $file) {
            $room->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $room->id]);
        }

        return redirect()->route('admin.rooms.index');
    }

    public function edit(Room $room)
    {
        abort_if(Gate::denies('room_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostels = Hostel::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilities = Facility::pluck('name', 'id');

        $room->load('hostel', 'facilities', 'created_by');

        return view('admin.rooms.edit', compact('facilities', 'hostels', 'room'));
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->all());
        $room->facilities()->sync($request->input('facilities', []));
        if (count($room->images) > 0) {
            foreach ($room->images as $media) {
                if (! in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $room->images->pluck('file_name')->toArray();
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $room->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.rooms.index');
    }

    public function show(Room $room)
    {
        abort_if(Gate::denies('room_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $room->load('hostel', 'facilities', 'created_by');

        return view('admin.rooms.show', compact('room'));
    }

    public function destroy(Room $room)
    {
        abort_if(Gate::denies('room_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $room->delete();

        return back();
    }

    public function massDestroy(MassDestroyRoomRequest $request)
    {
        $rooms = Room::find(request('ids'));

        foreach ($rooms as $room) {
            $room->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('room_create') && Gate::denies('room_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Room();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
