<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHostelRequest;
use App\Http\Requests\StoreHostelRequest;
use App\Http\Requests\UpdateHostelRequest;
use App\Models\Area;
use App\Models\Category;
use App\Models\Facility;
use App\Models\Hostel;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HostelController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('hostel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostels = Hostel::with(['area', 'facilities', 'categories', 'created_by', 'media'])->get();

        return view('admin.hostels.index', compact('hostels'));
    }

    public function create()
    {
        abort_if(Gate::denies('hostel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilities = Facility::pluck('name', 'id');

        $categories = Category::pluck('name', 'id');

        return view('admin.hostels.create', compact('areas', 'categories', 'facilities'));
    }

    public function store(StoreHostelRequest $request)
    {
        $hostel = Hostel::create($request->all());
        $hostel->facilities()->sync($request->input('facilities', []));
        $hostel->categories()->sync($request->input('categories', []));
        if ($request->input('featured_image', false)) {
            $hostel->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $hostel->id]);
        }

        return redirect()->route('admin.hostels.index');
    }

    public function edit(Hostel $hostel)
    {
        abort_if(Gate::denies('hostel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facilities = Facility::pluck('name', 'id');

        $categories = Category::pluck('name', 'id');

        $hostel->load('area', 'facilities', 'categories', 'created_by');

        return view('admin.hostels.edit', compact('areas', 'categories', 'facilities', 'hostel'));
    }

    public function update(UpdateHostelRequest $request, Hostel $hostel)
    {
        $hostel->update($request->all());
        $hostel->facilities()->sync($request->input('facilities', []));
        $hostel->categories()->sync($request->input('categories', []));
        if ($request->input('featured_image', false)) {
            if (!$hostel->featured_image || $request->input('featured_image') !== $hostel->featured_image->file_name) {
                if ($hostel->featured_image) {
                    $hostel->featured_image->delete();
                }
                $hostel->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($hostel->featured_image) {
            $hostel->featured_image->delete();
        }

        return redirect()->route('admin.hostels.index');
    }

    public function show(Hostel $hostel)
    {
        abort_if(Gate::denies('hostel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostel->load('area', 'facilities', 'categories', 'created_by', 'hostelRooms');

        return view('admin.hostels.show', compact('hostel'));
    }

    public function destroy(Hostel $hostel)
    {
        abort_if(Gate::denies('hostel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostel->delete();

        return back();
    }

    public function massDestroy(MassDestroyHostelRequest $request)
    {
        $hostels = Hostel::find(request('ids'));

        foreach ($hostels as $hostel) {
            $hostel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('hostel_create') && Gate::denies('hostel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Hostel();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
