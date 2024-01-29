@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <img src="{{ asset('images/registerLeft.png') }}" alt="" class="img-fluid">
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="col-md-12" id="step1">
                <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid">

                <p class="text-white " style="font-size: 25px">{{ trans('global.register') }}</p>
                <div class="row d-flex flex-row justify-content-between">
                    <p class="text-white m-auto">Please enter correct data </p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" style="color: blue" aria-current="page">Step 1</li>
                            <li class="breadcrumb-item">Step 2</li>
                        </ol>
                    </nav>
                </div>

                <!--- name -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #111111;">
                            <i class="fa fa-user fa-fw" style="color: white;"></i>
                        </span>
                    </div>
                    <input type="text" name="name" style="background-color: #111111;"
                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus
                        placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <!--- email -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #111111;">
                            <i class="fa fa-envelope fa-fw" style="color: white;"></i>
                        </span>
                    </div>
                    <input type="email" name="email" style="background-color: #111111;"
                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required
                        placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <!--- password -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #111111;">
                            <i class="fa fa-lock fa-fw" style="color: white;"></i>
                        </span>
                    </div>
                    <input type="password" name="password" style="background-color: #111111;"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required
                        placeholder="{{ trans('global.login_password') }}">
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <!--- password_confirmation -->
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #111111;">
                            <i class="fa fa-lock fa-fw" style="color: white;"></i>
                        </span>
                    </div>
                    <input type="password" name="password_confirmation" style="background-color: #111111;"
                        class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                </div>

                <!-- Next button to go to Step 2 -->
                <button type="button" class="btn btn-outlite border px-4 text-white" onclick="showStep(2)">Next</button>





            </div>
            <div class="col-md-12 d-none" id="step2">

                <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid">
                <p class="text-white " style="font-size: 25px">{{ trans('global.register') }}</p>
                <div class="row d-flex flex-row justify-content-between">
                    <p class="text-white m-auto ">Please enter correct data </p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item ">Step 1</li>
                            <li class="breadcrumb-item active" style="color: blue" aria-current="page">Step 2</li>
                        </ol>
                    </nav>
                </div>
                <!-- phone_number -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text "style="background-color: #111111;">
                            <i class="fa fa-phone fa-fw" style="color: white;"></i>
                        </span>
                    </div>
                    <input type="text" name="phone_number" style="background-color: #111111;"
                        class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" required
                        placeholder="{{ trans('cruds.user.fields.phone_number') }}" value="{{ old('phone_number', '') }}">
                    @if ($errors->has('phone_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.phone_number_helper') }}</span>
                </div>

                <!-- company_name -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #111111;">
                            <i class="fa fa-building fa-fw" style="color: white;"></i>
                        </span>
                    </div>
                    <input type="text" name="company_name" style="background-color: #111111;"
                        class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" required
                        placeholder="{{ trans('cruds.client.fields.company_name') }}"
                        value="{{ old('company_name', '') }}">
                    @if ($errors->has('company_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('company_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.company_name_helper') }}</span>
                </div>

                <!-- shop_name -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #111111;">
                            <i class="fa fa-shopping-cart fa-fw" style="color: white;"></i>
                        </span>
                    </div>
                    <input type="text" name="shop_name" style="background-color: #111111;"
                        class="form-control {{ $errors->has('shop_name') ? 'is-invalid' : '' }}" required
                        placeholder="{{ trans('cruds.client.fields.shop_name') }}" value="{{ old('shop_name', '') }}">
                    @if ($errors->has('shop_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('shop_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.shop_name_helper') }}</span>
                </div>
                <!-- commerical_record -->
                <div class="form-group">
                    <label class="required text-white" style="font-weight: bold;"
                        for="commerical_record">{{ trans('cruds.client.fields.commerical_record') }}</label>
                    <div style="background-color: #111111 !important ;"
                        class="needsclick dropzone {{ $errors->has('commerical_record') ? 'is-invalid' : '' }}"
                        id="commerical_record-dropzone">
                        <div class="dz-message">
                            <i class="fa fa-cloud-upload fa-3x"></i>
                            <br>
                            <span>Upload files here</span>
                        </div>
                    </div>
                    @if ($errors->has('commerical_record'))
                        <div class="invalid-feedback">
                            {{ $errors->first('commerical_record') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.commerical_record_helper') }}</span>
                </div>

                <!-- Back button to go back to Step 1 -->
                <button type="button" class="btn btn-outlite border px-4 text-white mb-5"
                    onclick="showStep(1)">Back</button>
                <button type="submit"
                    class="btn btn-block btn-outlite border px-4 text-white">{{ trans('global.register') }}</button>

            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        Dropzone.options.commericalRecordDropzone = {
            url: '{{ route('register.storeMedia') }}',
            maxFilesize: 2, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2
            },
            success: function(file, response) {
                $('form').find('input[name="commerical_record"]').remove()
                $('form').append('<input type="hidden" name="commerical_record" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="commerical_record"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($client) && $client->commerical_record)
                    var file = {!! json_encode($client->commerical_record) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="commerical_record" value="' + file.file_name +
                        '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }

        function showStep(step) {
            if (step === 1) {
                document.getElementById('step1').classList.remove('d-none');
                document.getElementById('step2').classList.add('d-none');
                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var password_confirmation = $('#password_confirmation').val();
            } else if (step === 2) {
                document.getElementById('step1').classList.add('d-none');
                document.getElementById('step2').classList.remove('d-none');
                var phoneNumber = $('#phone_number').val();
                var companyName = $('#company_name').val();
                var shopName = $('#shop_name').val();
            }
        }
    </script>
@endsection
