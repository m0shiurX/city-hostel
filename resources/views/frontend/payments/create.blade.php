@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.payment.title_singular') }}
                </div>

                <div class="card-body">
                    <div>
                        <h5>Payment Instruction</h5>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores tenetur iure praesentium quae perspiciatis iusto commodi, repudiandae at! Sit modi reprehenderit minus voluptatem atque saepe nobis? Porro adipisci nobis doloremque.</p>
                    </div>
                    <form method="POST" action="{{ route("frontend.payments.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="reservation_id" value="{{ $reservationId }}">
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.payment.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ $room_price }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group d-none">
                            <label class="required">{{ trans('cruds.payment.fields.status') }}</label>
                            @foreach(App\Models\Payment::STATUS_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', 'pending') === (string) $key ? 'checked' : '' }} required>
                                    <label for="status_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">Transaction {{ trans('cruds.payment.fields.description') }}</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description', '') }}">
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">Please provide transaction description such as TransactionID</span>
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