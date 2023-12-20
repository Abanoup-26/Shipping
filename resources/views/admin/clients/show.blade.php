@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.client.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.id') }}
                        </th>
                        <td>
                            {{ $client->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.user') }}
                        </th>
                        <td>
                            {{ $client->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.company_name') }}
                        </th>
                        <td>
                            {{ $client->company_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.shop_name') }}
                        </th>
                        <td>
                            {{ $client->shop_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.commerical_record') }}
                        </th>
                        <td>
                            @if($client->commerical_record)
                                <a href="{{ $client->commerical_record->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#client_client_financials" role="tab" data-toggle="tab">
                {{ trans('cruds.clientFinancial.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="client_client_financials">
            @includeIf('admin.clients.relationships.clientClientFinancials', ['clientFinancials' => $client->clientClientFinancials])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_orders">
            @includeIf('admin.clients.relationships.clientOrders', ['orders' => $client->clientOrders])
        </div>
    </div>
</div>

@endsection