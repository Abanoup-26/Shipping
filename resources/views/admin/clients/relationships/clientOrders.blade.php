@can('order_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.orders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.order.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header bg-dark  text-center fs-3 text-bold text-warning ">
        {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body bg-dark bg-gradient">
        <div class="table-responsive">
            <table
                class=" table table-warning table-bordered table-striped table-hover datatable datatable-clientOrders">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.order.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.client') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.shipment_company') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.order_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.pieces') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.destination') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.custom_value') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.delivery_status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr data-entry-id="{{ $order->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $order->id ?? '' }}
                            </td>
                            <td>
                                {{ $order->client->company_name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Order::SHIPMENT_COMPANY_SELECT[$order->shipment_company] ?? '' }}
                            </td>
                            <td>
                                {{ $order->order_code ?? '' }}
                            </td>
                            <td>
                                {{ $order->pieces ?? '' }}
                            </td>
                            <td>
                                {{ $order->destination ?? '' }}
                            </td>
                            <td>
                                {{ $order->description ?? '' }}
                            </td>
                            <td>
                                {{ $order->custom_value ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Order::DELIVERY_STATUS_SELECT[$order->delivery_status] ?? '' }}
                            </td>
                            <td>
                                @can('order_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.orders.show', $order->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('order_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.orders.edit', $order->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('order_delete')
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                            value="{{ trans('global.delete') }}">
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('order_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.orders.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-clientOrders:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
