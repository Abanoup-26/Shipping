@can('client_financial_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.client-financials.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.clientFinancial.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header bg-dark  text-center fs-3 text-bold text-warning">
        {{ trans('cruds.clientFinancial.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body bg-dark bg-gradient">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-clientClientFinancials">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.clientFinancial.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientFinancial.fields.client') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientFinancial.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientFinancial.fields.receipt_file') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientFinancials as $key => $clientFinancial)
                        <tr data-entry-id="{{ $clientFinancial->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $clientFinancial->id ?? '' }}
                            </td>
                            <td>
                                {{ $clientFinancial->client->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $clientFinancial->amount ?? '' }}
                            </td>
                            <td>
                                @if($clientFinancial->receipt_file)
                                    <a href="{{ $clientFinancial->receipt_file->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('client_financial_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.client-financials.show', $clientFinancial->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('client_financial_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.client-financials.edit', $clientFinancial->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('client_financial_delete')
                                    <form action="{{ route('admin.client-financials.destroy', $clientFinancial->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('client_financial_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.client-financials.massDestroy') }}",
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
    pageLength: 25,
  });
  let table = $('.datatable-clientClientFinancials:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection