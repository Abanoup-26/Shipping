@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.clientFinancial.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.client-financials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.clientFinancial.fields.id') }}
                        </th>
                        <td>
                            {{ $clientFinancial->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientFinancial.fields.client') }}
                        </th>
                        <td>
                            {{ $clientFinancial->client->company_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientFinancial.fields.amount') }}
                        </th>
                        <td>
                            {{ $clientFinancial->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientFinancial.fields.description') }}
                        </th>
                        <td>
                            {{ $clientFinancial->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.clientFinancial.fields.receipt_file') }}
                        </th>
                        <td>
                            @if($clientFinancial->receipt_file)
                                <a href="{{ $clientFinancial->receipt_file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.client-financials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection