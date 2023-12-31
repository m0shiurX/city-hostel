@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.payment.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.payments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $payment->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.reservation') }} - Price
                                    </th>
                                    <td>
                                        @if($payment->reservation)
                                                {{ $payment->reservation->room->room_info }} -
                                                {{ $payment->reservation->room->price ?? '' }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Paid {{ trans('cruds.payment.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $payment->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Payment::STATUS_RADIO[$payment->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $payment->description }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.payments.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection