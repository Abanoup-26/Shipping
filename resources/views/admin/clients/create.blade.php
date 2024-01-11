@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark  text-center fs-3 text-bold text-warning">
                {{ trans('global.add') }} {{ trans('cruds.client.title_singular') }}
            </div>
            <div class="card-body bg-dark bg-gradient">
                <form method="POST" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="approved" value="1">
                    <div class="container border border-warning p-5">

                        <!-- name -->
                        <div class="form-group row justify-content-center">
                            <label class="col-3 col-form-label text-warning text-bold fs-4 required"
                                for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <div class="col-6">
                                <input
                                    class="form-control bg-dark text-white {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                            </div>
                        </div>

                        <!-- email -->
                        <div class="form-group row justify-content-center">
                            <label class="col-3 col-form-label text-warning text-bold fs-4 required"
                                for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <div class="col-6">
                                <input
                                    class="form-control bg-dark text-white {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    type="email" name="email" id="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                            </div>
                        </div>

                        <!-- password -->
                        <div class="form-group row justify-content-center">
                            <label class="col-3 col-form-label text-warning text-bold fs-4 required"
                                for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <div class="col-6">
                                <input
                                    class="form-control bg-dark text-white {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    type="password" name="password" id="password" required>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                            </div>
                        </div>

                        <!-- phone_number -->
                        <div class="form-group row justify-content-center">
                            <label class="col-3 col-form-label text-warning text-bold fs-4 required"
                                for="phone_number">{{ trans('cruds.user.fields.phone_number') }}</label>
                            <div class="col-6">
                                <input
                                    class="form-control bg-dark text-white {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                                    type="text" name="phone_number" id="phone_number"
                                    value="{{ old('phone_number', '') }}" required>
                                @if ($errors->has('phone_number'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone_number') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.phone_number_helper') }}</span>
                            </div>
                        </div>

                        <!-- company_name -->
                        <div class="form-group row justify-content-center">
                            <label class="col-3 col-form-label text-warning text-bold fs-4 required"
                                for="company_name">{{ trans('cruds.client.fields.company_name') }}</label>
                            <div class="col-6">
                                <input
                                    class="form-control bg-dark text-white {{ $errors->has('company_name') ? 'is-invalid' : '' }}"
                                    type="text" name="company_name" id="company_name"
                                    value="{{ old('company_name', '') }}" required>
                                @if ($errors->has('company_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.client.fields.company_name_helper') }}</span>
                            </div>
                        </div>

                        <!-- shop_name -->
                        <div class="form-group row justify-content-center">
                            <label class="col-3 col-form-label text-warning text-bold fs-4 required"
                                for="shop_name">{{ trans('cruds.client.fields.shop_name') }}</label>
                            <div class="col-6">
                                <input
                                    class="form-control bg-dark text-white {{ $errors->has('shop_name') ? 'is-invalid' : '' }}"
                                    type="text" name="shop_name" id="shop_name" value="{{ old('shop_name', '') }}"
                                    required>
                                @if ($errors->has('shop_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('shop_name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.client.fields.shop_name_helper') }}</span>
                            </div>
                        </div>

                        <!-- commerical_record -->
                        <div class="form-group row justify-content-center">
                            <label class="col-3 m-auto col-form-label text-warning text-bold fs-4"
                                for="commerical_record">{{ trans('cruds.client.fields.commerical_record') }}</label>
                            <div class="col-6">
                                <div class="bg-dark col-6 col-md-4 dropzone needsclick {{ $errors->has('commerical_record') ? 'is-invalid' : '' }}"
                                    id="commerical_record-dropzone">
                                    <div class="dz-message">
                                        <i class="fa fa-cloud-upload fa-3x"></i>
                                        <span class=" text-light"> Select File </span>
                                    </div>
                                </div>
                            </div>


                            @if ($errors->has('commerical_record'))
                                <div class="col-12 invalid-feedback">
                                    {{ $errors->first('commerical_record') }}
                                </div>
                            @endif

                            <small
                                class="col-12 form-text text-muted">{{ trans('cruds.client.fields.commerical_record_helper') }}</small>
                        </div>

                        <div class="form-group container text-center mt-3">
                            <button class="btn btn-warning col-6" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        Dropzone.options.commericalRecordDropzone = {
            url: '{{ route('admin.clients.storeMedia') }}',
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
