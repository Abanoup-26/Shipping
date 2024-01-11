@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header bg-dark  text-center fs-3 text-bold text-warning">
            {{ trans('global.create') }} {{ trans('cruds.clientFinancial.title_singular') }}
        </div>

        <div class="card-body bg-dark bg-gradient">
            <form method="POST" action="{{ route('admin.client-financials.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="container border border-warning p-5">
                    <div class="form-group row justify-content-center">
                        <label class="col-3 col-form-label text-warning text-bold fs-4 required"
                            for="client_id">{{ trans('cruds.clientFinancial.fields.client') }}</label>
                        <div class="col-6">
                            <select
                                class="form-control bg-dark text-white select2 {{ $errors->has('client') ? 'is-invalid' : '' }}"
                                name="client_id" id="client_id" required>
                                @foreach ($clients as $id => $entry)
                                    <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>
                                        {{ $entry }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.clientFinancial.fields.client_helper') }}</span>
                        </div>

                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-3 col-form-label text-warning text-bold fs-4 required"
                            for="amount">{{ trans('cruds.clientFinancial.fields.amount') }}</label>
                        <div class="col-6">
                            <input class="form-control bg-dark text-white {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                type="number" name="amount" id="amount" value="{{ old('amount', '') }}">
                            @if ($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.clientFinancial.fields.amount_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-3 col-form-label text-warning text-bold fs-4 required"
                            for="description">{{ trans('cruds.clientFinancial.fields.description') }}</label>
                        <div class="col-6">
                            <textarea class="form-control bg-dark text-white {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                name="description" id="description">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.clientFinancial.fields.description_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-3 m-auto col-form-label text-warning text-bold fs-4"
                            for="receipt_file">{{ trans('cruds.clientFinancial.fields.receipt_file') }}</label>
                        <div class="col-6">
                            <div class="bg-dark col-6 col-md-4 needsclick dropzone {{ $errors->has('receipt_file') ? 'is-invalid' : '' }}"
                                id="receipt_file-dropzone">

                                <div class="dz-message">
                                    <i class="fa fa-cloud-upload fa-3x"></i>
                                    <span class=" text-light"> Select File </span>
                                </div>
                            </div>
                        </div>

                        @if ($errors->has('receipt_file'))
                            <div class="invalid-feedback">
                                {{ $errors->first('receipt_file') }}
                            </div>
                        @endif
                        <small
                            class="col-12 form-text text-muted">{{ trans('cruds.clientFinancial.fields.receipt_file_helper') }}</small>
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
@endsection

@section('scripts')
    <script>
        Dropzone.options.receiptFileDropzone = {
            url: '{{ route('admin.client-financials.storeMedia') }}',
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
                $('form').find('input[name="receipt_file"]').remove()
                $('form').append('<input type="hidden" name="receipt_file" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="receipt_file"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($clientFinancial) && $clientFinancial->receipt_file)
                    var file = {!! json_encode($clientFinancial->receipt_file) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="receipt_file" value="' + file.file_name + '">')
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
