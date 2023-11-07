@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.reservation.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.reservations.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="room_id">{{ trans('cruds.reservation.fields.room') }}</label>
                            <select class="form-control select2" name="room_id" id="room_id" required>
                                @foreach($rooms as $id => $entry)
                                    <option value="{{ $id }}" {{ old('room_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('room'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('room') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.room_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="paid_amount">{{ trans('cruds.reservation.fields.paid_amount') }}</label>
                            <input class="form-control" type="number" name="paid_amount" id="paid_amount" value="{{ old('paid_amount', '') }}" step="0.01">
                            @if($errors->has('paid_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('paid_amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.paid_amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.reservation.fields.status') }}</label>
                            @foreach(App\Models\Reservation::STATUS_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '') === (string) $key ? 'checked' : '' }}>
                                    <label for="status_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.reservation.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection