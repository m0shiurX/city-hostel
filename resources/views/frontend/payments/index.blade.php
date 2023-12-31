@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.payment.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Payment">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payment.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payment.fields.reservation') }} - Total Price
                                    </th>
                                    <th>
                                        Paid {{ trans('cruds.payment.fields.amount') }}
                                    </th>
                                    <th>
                                        Payment {{ trans('cruds.payment.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.payment.fields.description') }}
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $key => $payment)
                                    <tr data-entry-id="{{ $payment->id }}">
                                        <td>
                                            {{ $payment->id ?? '' }}
                                        </td>
                                        <td>
                                            @if($payment->reservation)
                                                {{ $payment->reservation->room->room_info }} -
                                                {{ $payment->reservation->room->price ?? '' }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $payment->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Payment::STATUS_RADIO[$payment->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $payment->description ?? '' }}
                                        </td>
                                        <td>
                                            @can('payment_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.payments.show', $payment->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan
                                            
                                            @if($payment->status !== 'approved')
                                            @can('payment_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.payments.edit', $payment->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('payment_delete')
                                                <form action="{{ route('frontend.payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
$(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    
    @can('payment_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('frontend.payments.massDestroy') }}",
        className: 'btn-danger',
        action: function (e, dt, node, config) {
            var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
            });

            if (ids.length === 0) {
            alert('{{ trans('global.datatables.zero_selected') }}')

            return
            }

            if (confirm('{{ trans('global.areYouSure') }}')) {
            $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
            }
        }
    }
    dtButtons.push(deleteButton)
    @endcan

    $.extend(true, $.fn.dataTable.defaults, {
        orderCellsTop: true,
        order: [[ 1, 'desc' ]],
        pageLength: 100,
    });
    let table = $('.datatable-Payment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
</script>
@endsection