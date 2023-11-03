@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('room_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.rooms.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.room.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.room.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Room">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.room.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.room.fields.hostel') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hostel.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hostel.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.room.fields.room_info') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.room.fields.price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.room.fields.capacity') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.room.fields.placement') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.room.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.room.fields.tag') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $key => $room)
                                    <tr data-entry-id="{{ $room->id }}">
                                        <td>
                                            {{ $room->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $room->hostel->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $room->hostel->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $room->hostel->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $room->room_info ?? '' }}
                                        </td>
                                        <td>
                                            {{ $room->price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $room->capacity ?? '' }}
                                        </td>
                                        <td>
                                            {{ $room->placement ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Room::STATUS_RADIO[$room->status] ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($room->tags as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('room_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.rooms.show', $room->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('room_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.rooms.edit', $room->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('room_delete')
                                                <form action="{{ route('frontend.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('room_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.rooms.massDestroy') }}",
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
  let table = $('.datatable-Room:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection