@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.reservation.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Reservation">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.reservation.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.reservation.fields.room') }}
                                    </th>
                                    <th class="text-center">
                                        Total {{ trans('cruds.room.fields.price') }}
                                    </th>
                                    <th>
                                        Room Status
                                    </th>
                                    <th>
                                        Reservation Status
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
                                            {{ $reservation->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $reservation->room->room_info ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $reservation->room->price ?? '' }}
                                        </td>
                                        <td>
                                            @if($reservation->room)
                                                {{ $reservation->room::STATUS_RADIO[$reservation->room->status] ?? '' }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ App\Models\Reservation::STATUS_RADIO[$reservation->status] ?? '' }}
                                        </td>
                                        <td>
                                            @can('reservation_show')
                                                @if ($reservation->status === 'approved')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.reservations.show', $reservation->id) }}">
                                                    {{ trans('global.view') }} Details
                                                </a>
                                                @elseif($reservation->status === 'unpaid')
                                                <a class="btn btn-xs btn-success" href="{{ route('frontend.payments.create', ['reservation_id' => $reservation->id]) }}">
                                                    Make payment
                                                </a>
                                                @else
                                                <a class="btn btn-xs btn-warning" href="javascript:void">
                                                    Awaiting Approval
                                                </a>
                                                @endif
                                            @endcan

                                            @can('reservation_delete')
                                                <form action="{{ route('frontend.reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('frontend.reservations.massDestroy') }}",
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