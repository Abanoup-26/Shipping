@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card mx-4">
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <h1 class="text-center mb-5">{{ trans('panel.site_title') }}</h1>
                        <hr>
                        <p class="text-muted">{{ trans('global.register') }}</p>
                        <!--- name -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user fa-fw"></i>
                                </span>
                            </div>
                            <input type="text" name="name"
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
                                <span class="input-group-text">
                                    <i class="fa fa-envelope fa-fw"></i>
                                </span>
                            </div>
                            <input type="email" name="email"
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
                                <span class="input-group-text">
                                    <i class="fa fa-lock fa-fw"></i>
                                </span>
                            </div>
                            <input type="password" name="password"
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
                                <span class="input-group-text">
                                    <i class="fa fa-lock fa-fw"></i>
                                </span>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control" required
                                placeholder="{{ trans('global.login_password_confirmation') }}">
                        </div>
                        <!-- phone_number -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-phone fa-fw"></i>
                                </span>
                            </div>
                            <input type="text" name="phone_number"
                                class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" required
                                placeholder="{{ trans('cruds.user.fields.phone_number') }}"
                                value="{{ old('phone_number', '') }}">
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
                                <span class="input-group-text">
                                    <i class="fa fa-building fa-fw"></i>
                                </span>
                            </div>
                            <input type="text" name="company_name"
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
                                <span class="input-group-text">
                                    <i class="fa fa-shopping-cart fa-fw"></i>
                                </span>
                            </div>
                            <input type="text" name="shop_name"
                                class="form-control {{ $errors->has('shop_name') ? 'is-invalid' : '' }}" required
                                placeholder="{{ trans('cruds.client.fields.shop_name') }}"
                                value="{{ old('shop_name', '') }}">
                            @if ($errors->has('shop_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('shop_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.shop_name_helper') }}</span>
                        </div>
                        <!-- commerical_record -->
                        <div class="form-group">
                            <label class="required"
                                for="commerical_record">{{ trans('cruds.client.fields.commerical_record') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('commerical_record') ? 'is-invalid' : '' }}"
                                id="commerical_record-dropzone">
                            </div>
                            @if ($errors->has('commerical_record'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('commerical_record') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.client.fields.commerical_record_helper') }}</span>
                        </div>
                        <button class="btn btn-block btn-primary">
                            {{ trans('global.register') }}
                        </button>
                    </form>

                </div>
            </div>

        </div>
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
    </script>
@endsection
