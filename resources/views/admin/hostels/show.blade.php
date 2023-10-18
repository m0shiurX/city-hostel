@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hostel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hostels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.id') }}
                        </th>
                        <td>
                            {{ $hostel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.name') }}
                        </th>
                        <td>
                            {{ $hostel->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.address') }}
                        </th>
                        <td>
                            {{ $hostel->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.phone') }}
                        </th>
                        <td>
                            {{ $hostel->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.note') }}
                        </th>
                        <td>
                            {!! $hostel->note !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.user') }}
                        </th>
                        <td>
                            {{ $hostel->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hostels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#hostel_rooms" role="tab" data-toggle="tab">
                {{ trans('cruds.room.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="hostel_rooms">
            @includeIf('admin.hostels.relationships.hostelRooms', ['rooms' => $hostel->hostelRooms])
        </div>
    </div>
</div>

@endsection