@can('hostel_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.hostels.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.hostel.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.hostel.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-areaHostels">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.hostel.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.hostel.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.hostel.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.hostel.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.hostel.fields.built_on') }}
                        </th>
                        <th>
                            {{ trans('cruds.hostel.fields.total_seat') }}
                        </th>
                        <th>
                            {{ trans('cruds.hostel.fields.garage') }}
                        </th>
                        <th>
                            {{ trans('cruds.hostel.fields.garage_size') }}
                        </th>
                        <th>
                            {{ trans('cruds.hostel.fields.area') }}
                        </th>
                        <th>
                            {{ trans('cruds.hostel.fields.facility') }}
                        </th>
                        <th>
                            {{ trans('cruds.hostel.fields.category') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hostels as $key => $hostel)
                        <tr data-entry-id="{{ $hostel->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $hostel->id ?? '' }}
                            </td>
                            <td>
                                {{ $hostel->name ?? '' }}
                            </td>
                            <td>
                                {{ $hostel->phone ?? '' }}
                            </td>
                            <td>
                                {{ $hostel->address ?? '' }}
                            </td>
                            <td>
                                {{ $hostel->built_on ?? '' }}
                            </td>
                            <td>
                                {{ $hostel->total_seat ?? '' }}
                            </td>
                            <td>
                                {{ $hostel->garage ?? '' }}
                            </td>
                            <td>
                                {{ $hostel->garage_size ?? '' }}
                            </td>
                            <td>
                                {{ $hostel->area->name ?? '' }}
                            </td>
                            <td>
                                @foreach($hostel->facilities as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($hostel->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('hostel_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.hostels.show', $hostel->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('hostel_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.hostels.edit', $hostel->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('hostel_delete')
                                    <form action="{{ route('admin.hostels.destroy', $hostel->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('hostel_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hostels.massDestroy') }}",
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
  let table = $('.datatable-areaHostels:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection