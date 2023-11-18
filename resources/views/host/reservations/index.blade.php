@extends('layouts.host')
@section('content')
@can('reservation_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('host.reservations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.reservation.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.reservation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Reservation">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th width="15">
                            {{ trans('cruds.reservation.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.room') }}
                        </th>
                        <th>
                            {{ trans('cruds.room.fields.price') }}
                        </th>
                        <th>
                            Reservation {{ trans('cruds.reservation.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.title') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $key => $reservation)
                        <tr data-entry-id="{{ $reservation->id }}">
                            <td>
                            </td>
                            <td class="text-center">
                                {{ $reservation->id ?? '' }}
                            </td>
                            <td>
                                {{ $reservation->room->room_info ?? '' }}
                            </td>
                            <td>
                                {{ $reservation->room->price ?? '' }}
                            </td>
                            
                            <td>
                                {{ App\Models\Reservation::STATUS_RADIO[$reservation->status] ?? '' }}
                            </td>
                            <td>
                                {{ $reservation->payment?->status ?? 'Waiting for Payment' }}
                            </td>
                            <td>
                                @if($reservation->payment?->status === 'pending')
                                    <a class="btn btn-xs btn-primary" href="{{ route('host.payments.show', $reservation->payment->id) }}">
                                        Check Payment
                                    </a>
                                @elseif($reservation->payment?->status === 'approved' && $reservation->status !== 'approved')
                                    <form method="POST" action="{{ route("host.reservations.approve", $reservation->id) }}" enctype="multipart/form-data">
                                        @method('POST')
                                        @csrf
                                        <div class="form-group">
                                            <button  type="submit" class="btn btn-xs  btn-success">Approve</button>
                                        </div>
                                    </form>
                                @elseif($reservation->payment?->status === 'unpaid' || is_null($reservation->payment))
                                    <form method="POST" action="{{ route("host.reservations.disapprove", $reservation->id) }}" enctype="multipart/form-data">
                                        @method('POST')
                                        @csrf
                                        <div class="form-group">
                                            <button  type="submit" class="btn btn-xs  btn-warning">Cancel</button>
                                        </div>
                                    </form>
                                @elseif($reservation->payment?->status === 'cancelled' && $reservation->status !== 'cancelled')
                                    <form method="POST" action="{{ route("host.reservations.disapprove", $reservation->id) }}" enctype="multipart/form-data">
                                        @method('POST')
                                        @csrf
                                        <div class="form-group">
                                            <button  type="submit" class="btn btn-xs  btn-warning">Cancel</button>
                                        </div>
                                    </form>
                                @endif
                                

                                @can('reservation_delete')
                                    <form action="{{ route('host.reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('reservation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('host.reservations.massDestroy') }}",
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
  let table = $('.datatable-Reservation:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection