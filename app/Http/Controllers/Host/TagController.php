<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTagRequest;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::all();

        return view('host.tags.index', compact('tags'));
    }

    public function create()
    {
        abort_if(Gate::denies('tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('host.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        $tag = Tag::create($request->all());

        return redirect()->route('host.tags.index');
    }

    public function edit(Tag $tag)
    {
        abort_if(Gate::denies('tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('host.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->all());

        return redirect()->route('host.tags.index');
    }

    public function destroy(Tag $tag)
    {
        abort_if(Gate::denies('tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tag->delete();

        return back();
    }

    public function massDestroy(MassDestroyTagRequest $request)
    {
        $tags = Tag::find(request('ids'));

        foreach ($tags as $tag) {
            $tag->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
