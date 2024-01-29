@extends('layouts.app')
@section('content')
    <div class="row justify-content-center ">
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/loginLeft.png') }}" alt="" class="img-fluid">
        </div>
        <div class="col m-auto flex justify-content-center">
            <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid">

            <p class="text-white " style="font-size: 30px;">{{ trans('global.login') }}</p>
            <br>
            <p class="text-white "> Please Enter an Account</p>
            @if (session('message'))
                <div class="alert alert-info" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text "style="background-color: #111111;">
                            <i class="fa fa-user" style="color: white;"></i>
                        </span>
                    </div>

                    <input id="email" name="email" type="text" style="background-color: #111111;"
                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email"
                        autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">

                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #111111;"><i
                                class="fa fa-lock"style="color: white;"></i></span>
                    </div>

                    <input id="password" name="password" type="password" style="background-color: #111111;"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required
                        placeholder="{{ trans('global.login_password') }}">

                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="input-group mb-4">
                    <div class="form-check checkbox">
                        <input class="form-check-input" name="remember" type="checkbox" id="remember"
                            style="vertical-align: middle;" />
                        <label class="form-check-label" for="remember" style="vertical-align: middle;">
                            {{ trans('global.remember_me') }}
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-outlite border px-4 " style="font-size: 25px">
                            {{ trans('global.login') }}
                        </button>
                    </div>
                    <div class="col-6 text-right">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link px-0" href="{{ route('password.request') }}" style="color: white">
                                {{ trans('global.forgot_password') }}
                            </a><br>
                        @endif
                        <a class="btn btn-link px-0" href="{{ route('register') }}" style="color: white">
                            {{ trans('global.register') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
