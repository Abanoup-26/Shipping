@extends('layouts.frontend')
@section('content')
    <h1>
        CLient name : {{ $client->user->name }} ClientID:{{ $client->id }} - ClientUID : {{ $client->user_id }}
    </h1>
    <h2>Client Financials</h2>
    <h5>Client total Financials {{ $totalAmount }}</h5>
@endsection
