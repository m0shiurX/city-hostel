@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.reservation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reservations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="room_id">{{ trans('cruds.reservation.fields.room') }}</label>
                <select class="form-control select2 {{ $errors->has('room') ? 'is-invalid' : '' }}" name="room_id" id="room_id" required>
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
                <label for="payable_amount">{{ trans('cruds.reservation.fields.payable_amount') }}</label>
                <input class="form-control {{ $errors->has('payable_amount') ? 'is-invalid' : '' }}" type="number" name="payable_amount" id="payable_amount" value="{{ old('payable_amount', '') }}" step="0.01">
                @if($errors->has('payable_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payable_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reservation.fields.payable_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.reservation.fields.status') }}</label>
                @foreach(App\Models\Reservation::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
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



@endsection