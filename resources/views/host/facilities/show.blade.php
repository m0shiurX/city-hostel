@extends('layouts.host')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.facility.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('host.facilities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.facility.fields.id') }}
                        </th>
                        <td>
                            {{ $facility->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.facility.fields.name') }}
                        </th>
                        <td>
                            {{ $facility->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.facility.fields.details') }}
                        </th>
                        <td>
                            {{ $facility->details }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('host.facilities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection