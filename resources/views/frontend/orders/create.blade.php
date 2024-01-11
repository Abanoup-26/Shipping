@extends('layouts.frontend')
@section('content')
    <div class="card">
        <div class="card-header bg-dark  text-center fs-3 text-bold text-warning">
            {{ trans('global.create') }} {{ trans('cruds.order.title_singular') }}
        </div>

        <div class="card-body bg-dark bg-gradient">
            <form method="POST" action="{{ route('client.orders.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="container border border-warning p-5">
                    <div class="row justify-content-center">
                        <div class="form-group col-4 ">
                            <label
                                class="form-label text-warning text-bold fs-4 required">{{ trans('cruds.order.fields.shipment_company') }}</label>
                            <select
                                class=" bg-dark text-white form-control {{ $errors->has('shipment_company') ? 'is-invalid' : '' }}"
                                name="shipment_company" id="shipment_company">
                                <option value disabled {{ old('shipment_company', null) === null ? 'selected' : '' }}>
                                    {{ trans('global.pleaseSelect') }}</option>
                                @foreach (App\Models\Order::SHIPMENT_COMPANY_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('shipment_company', '') === (string) $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('shipment_company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('shipment_company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.shipment_company_helper') }}</span>


                        </div>
                        <div class="form-group col-4 ">
                            <label class=" form-label text-warning text-bold fs-4 required"
                                for="destination">{{ trans('cruds.order.fields.destination') }}</label>

                            <input
                                class="form-control bg-dark text-white {{ $errors->has('destination') ? 'is-invalid' : '' }}"
                                type="text" name="destination" id="destination" value="{{ old('destination', '') }}">
                            @if ($errors->has('destination'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('destination') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.destination_helper') }}</span>

                        </div>
                        <div class="form-group col-4 ">
                            <label class="col-3 form-label text-warning text-bold fs-4 "
                                for="weight">{{ trans('cruds.order.fields.weight') }}</label>

                            <input class="form-control bg-dark text-white {{ $errors->has('weight') ? 'is-invalid' : '' }}"
                                type="text" name="weight" id="weight" value="{{ old('weight', '') }}">
                            @if ($errors->has('weight'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('weight') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.weight_helper') }}</span>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6  ">
                            <label class="form-label text-warning text-bold fs-4 "
                                for="from">{{ trans('cruds.order.fields.from') }}</label>

                            <textarea class="form-control bg-dark text-white ckeditor {{ $errors->has('from') ? 'is-invalid' : '' }}"
                                name="from" id="from">{!! old('from') !!}</textarea>
                            @if ($errors->has('from'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('from') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.from_helper') }}</span>

                        </div>
                        <div class="form-group col-6 ">
                            <label class=" form-label text-warning text-bold fs-4 "
                                for="to">{{ trans('cruds.order.fields.to') }}</label>

                            <textarea class="form-control ckeditor {{ $errors->has('to') ? 'is-invalid' : '' }}" name="to" id="to">{!! old('to') !!}</textarea>
                            @if ($errors->has('to'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('to') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.to_helper') }}</span>

                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-3 form-label text-warning text-bold fs-4"
                            for="chargeable">{{ trans('cruds.order.fields.chargeable') }}</label>
                        <div class="col-6">
                            <input
                                class="form-control bg-dark text-white {{ $errors->has('chargeable') ? 'is-invalid' : '' }}"
                                type="text" name="chargeable" id="chargeable" value="{{ old('chargeable', '') }}">
                            @if ($errors->has('chargeable'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('chargeable') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.chargeable_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-3 form-label text-warning text-bold fs-4"
                            for="pieces">{{ trans('cruds.order.fields.pieces') }}</label>
                        <div class="col-6">
                            <input class="form-control bg-dark text-white {{ $errors->has('pieces') ? 'is-invalid' : '' }}"
                                type="number" name="pieces" id="pieces" value="{{ old('pieces', '') }}"
                                step="1">
                            @if ($errors->has('pieces'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pieces') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.pieces_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-3 form-label text-warning text-bold fs-4"
                            for="pickup_date">{{ trans('cruds.order.fields.pickup_date') }}</label>
                        <div class="col-6">
                            <input
                                class="form-control  bg-dark text-white datetime {{ $errors->has('pickup_date') ? 'is-invalid' : '' }}"
                                type="text" name="pickup_date" id="pickup_date" value="{{ old('pickup_date') }}">
                            @if ($errors->has('pickup_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pickup_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.pickup_date_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-3 form-label text-warning text-bold fs-4"
                            for="cash_on_delivery">{{ trans('cruds.order.fields.cash_on_delivery') }}</label>
                        <div class="col-6">
                            <input
                                class="form-control bg-dark text-white {{ $errors->has('cash_on_delivery') ? 'is-invalid' : '' }}"
                                type="number" name="cash_on_delivery" id="cash_on_delivery"
                                value="{{ old('cash_on_delivery', '') }}" step="0.01">
                            @if ($errors->has('cash_on_delivery'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cash_on_delivery') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.cash_on_delivery_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-3 form-label text-warning text-bold fs-4"
                            for="description">{{ trans('cruds.order.fields.description') }}</label>
                        <div class="col-6">
                            <textarea class="form-control bg-dark text-white {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                name="description" id="description">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.description_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-3 form-label text-warning text-bold fs-4"
                            for="custom_value">{{ trans('cruds.order.fields.custom_value') }}</label>
                        <div class="col-6">
                            <input
                                class="form-control bg-dark text-white {{ $errors->has('custom_value') ? 'is-invalid' : '' }}"
                                type="number" name="custom_value" id="custom_value"
                                value="{{ old('custom_value', '') }}" step="0.01">
                            @if ($errors->has('custom_value'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('custom_value') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.custom_value_helper') }}</span>
                        </div>
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
        $(document).ready(function() {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function(file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST',
                                            '{{ route('client.orders.storeCKEditorImages') }}',
                                            true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText =
                                            `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() {
                                            reject(genericErrorText)
                                        });
                                        xhr.addEventListener('abort', function() {
                                            reject()
                                        });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response
                                                    .message ?
                                                    `${genericErrorText}\n${xhr.status} ${response.message}` :
                                                    `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`
                                                );
                                            }

                                            $('form').append(
                                                '<input type="hidden" name="ck-media[]" value="' +
                                                response.id + '">');

                                            resolve({
                                                default: response.url
                                            });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(
                                                e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Send request
                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', '{{ $order->id ?? 0 }}');
                                        xhr.send(data);
                                    });
                                })
                        }
                    };
                }
            }

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });
    </script>
@endsection
