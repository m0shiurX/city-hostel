@extends('layouts.host')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.payment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('host.payments.index') }}">
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
                            {{ trans('cruds.payment.fields.amount') }}
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
                <form method="POST" action="{{ route("host.payments.approve", $payment->id) }}" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        @if($payment->status === 'approved')
                        <a class="btn btn-primary" href="{{ route('host.reservations.index') }}">
                            Back to Reservations
                        </a>
                        @else
                        <button type="submit" class="btn btn-success mr-3">Approve</button> 
                        @endif
                        <a class="btn btn-default" href="{{ route('host.payments.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection