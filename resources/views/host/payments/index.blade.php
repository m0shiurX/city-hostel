@extends('layouts.host')
@section('content')
@can('payment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('host.payments.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.payment.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.payment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Payment">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th  width="15">
                            {{ trans('cruds.payment.fields.id') }}
                        </th>
                        <th>
                            Reservation - Status
                        </th>
                        <th class="text-center">
                            Room Price
                        </th>
                        <th>
                            Paid Amount
                        </th>
                        <th>
                            Transaction ID
                        </th>
                        <th>
                            Payment Status
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $key => $payment)
                        <tr data-entry-id="{{ $payment->id }}">
                            <td>
                            </td>
                            <td class="text-center">
                                {{ $payment->id ?? '' }}
                            </td>
                            <td>
                                {{ $payment->reservation->room->room_info ?? '' }} -
                                @if($payment->reservation)
                                    {{ $payment->reservation::STATUS_RADIO[$payment->reservation->status] ?? '' }}
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $payment->reservation->room->price ?? '' }}
                                
                            </td>
                            <td>
                                {{ $payment->amount ?? '' }}
                            </td>
                             <td>
                                 {{ $payment->description ?? ''}}
                                
                            </td>
                            <td>
                                {{ App\Models\Payment::STATUS_RADIO[$payment->status] ?? '' }}
                            </td>
                            <td>
                                @can('payment_edit')
                                        <form action="" method="post">
                                            @csrf
                                            @method('POST')
                                            <button class="btn btn-xs btn-info" type="submit">Approve</button>
                                        </form>
                                @endcan
                                @can('payment_edit')
                                        <form action="" method="post">
                                            @csrf
                                            @method('POST')
                                            <button class="btn btn-xs btn-danger" type="submit">Cancel</button>
                                        </form>
                                @endcan

                                @can('payment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('host.payments.show', $payment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                {{-- 
                                @can('payment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('host.payments.edit', $payment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan --}}
                                @can('payment_delete')
                                    <form action="{{ route('host.payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
    url: "{{ route('host.payments.massDestroy') }}",
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