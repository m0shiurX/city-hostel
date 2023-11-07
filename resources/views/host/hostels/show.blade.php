@extends('layouts.host')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hostel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('host.hostels.index') }}">
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
                            {{ trans('cruds.hostel.fields.phone') }}
                        </th>
                        <td>
                            {{ $hostel->phone }}
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
                            {{ trans('cruds.hostel.fields.built_on') }}
                        </th>
                        <td>
                            {{ $hostel->built_on }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.total_seat') }}
                        </th>
                        <td>
                            {{ $hostel->total_seat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.garage') }}
                        </th>
                        <td>
                            {{ $hostel->garage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.garage_size') }}
                        </th>
                        <td>
                            {{ $hostel->garage_size }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.amenities') }}
                        </th>
                        <td>
                            {!! $hostel->amenities !!}
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
                            {{ trans('cruds.hostel.fields.area') }}
                        </th>
                        <td>
                            {{ $hostel->area->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.facility') }}
                        </th>
                        <td>
                            @foreach($hostel->facilities as $key => $facility)
                                <span class="label label-info">{{ $facility->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.category') }}
                        </th>
                        <td>
                            @foreach($hostel->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostel.fields.featured_image') }}
                        </th>
                        <td>
                            @if($hostel->featured_image)
                                <a href="{{ $hostel->featured_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $hostel->featured_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('host.hostels.index') }}">
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
            @includeIf('host.hostels.relationships.hostelRooms', ['rooms' => $hostel->hostelRooms])
        </div>
    </div>
</div>

@endsection
