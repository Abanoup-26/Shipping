@extends('layouts.frontend')
@section('content')
@section('styles')
<style>
    #User_Data {
        background-color: #f8f9fa;
        padding: 20px 0;
    }

    .icon-box {
        background-color: #ffffffb8;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        padding: 5px;
        transition: transform 0.3s ease-in-out;
        margin-bottom: 10px;
        border-radius: 12px;
        /* Add margin between boxes */
    }

    .icon-box:hover {
        transform: translateY(-5px);
    }

    .card-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
        text-align: center;
        text-decoration: underline;
    }

    .icon-box-content p {
        font-size: 16px;
        font-weight: 900;
        color: #ff1a0eb1;
        margin-bottom: 0;
        padding: 10px;
    }

    .icon-box-content .img-container {
        display: flex;
        justify-content: center;
        align-items: center;

    }
</style>
@endsection
<div class="container ">
    <div class="row">
        <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box d-flex">
                <div class="icon-box-content">
                    <h3 class="card-title text-uppercase text-dark">
                        {{ trans('cruds.user.fields.id') }}
                    </h3>
                    <p>{{ $client->user->id ?? '' }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box d-flex">
                <div class="icon-box-content">
                    <h3 class="card-title ">
                        {{ trans('cruds.client.fields.user') }}
                    </h3>
                    <p>{{ $client->user->name ?? '' }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box d-flex">
                <div class="icon-box-content">
                    <h3 class="card-title text-uppercase text-dark">
                        {{ trans('cruds.client.fields.company_name') }}
                    </h3>
                    <p>{{ $client->company_name ?? '' }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box d-flex">
                <div class="icon-box-content">
                    <h3 class="card-title text-uppercase text-dark">
                        {{ trans('cruds.client.fields.shop_name') }}
                    </h3>
                    <p>{{ $client->shop_name ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6 justify-content-center">
            <div class="icon-box d-flex">
                <div class="icon-box-content">
                    <h3 class="card-title text-uppercase text-dark">
                        {{ trans('cruds.client.fields.commerical_record') }}
                    </h3>

                    @if ($client->commerical_record)
                        <a class="img-container" href="{{ $client->commerical_record->getUrl() }}"
                            target="_blank">
                            <img class="m-3" src="{{ $client->commerical_record->getUrl() }}"
                                alt="" width="50%" height="50%">
                        </a>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
