@extends('layouts.frontend')
@section('content')
    <div class="row">
        <div class="col-8">
            <h4>{{ trans('cruds.client.fields.user') }} : {{ $client->user->name }}</h4>
        </div>

        <div class="col-4 text-end">
            <h4>{{ trans('cruds.client.fields.id') }}:{{ $client->id }}</h4>
        </div>
    </div>
    <br>
    <h2>{{ trans('cruds.clientFinancial.title_singular') }}</h2>
    <br>
    <h5>{{ trans('cruds.clientFinancial.fields.total_amount') }} : {{ $totalAmount }}</h5>
@endsection
