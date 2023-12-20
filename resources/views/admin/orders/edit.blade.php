@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.update", [$order->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.order.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $order->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.shipment_company') }}</label>
                <select class="form-control {{ $errors->has('shipment_company') ? 'is-invalid' : '' }}" name="shipment_company" id="shipment_company">
                    <option value disabled {{ old('shipment_company', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Order::SHIPMENT_COMPANY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('shipment_company', $order->shipment_company) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('shipment_company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipment_company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.shipment_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order_code">{{ trans('cruds.order.fields.order_code') }}</label>
                <input class="form-control {{ $errors->has('order_code') ? 'is-invalid' : '' }}" type="text" name="order_code" id="order_code" value="{{ old('order_code', $order->order_code) }}">
                @if($errors->has('order_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.order_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="from">{{ trans('cruds.order.fields.from') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('from') ? 'is-invalid' : '' }}" name="from" id="from">{!! old('from', $order->from) !!}</textarea>
                @if($errors->has('from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="to">{{ trans('cruds.order.fields.to') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('to') ? 'is-invalid' : '' }}" name="to" id="to">{!! old('to', $order->to) !!}</textarea>
                @if($errors->has('to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('to') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="weight">{{ trans('cruds.order.fields.weight') }}</label>
                <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="text" name="weight" id="weight" value="{{ old('weight', $order->weight) }}">
                @if($errors->has('weight'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weight') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="chargeable">{{ trans('cruds.order.fields.chargeable') }}</label>
                <input class="form-control {{ $errors->has('chargeable') ? 'is-invalid' : '' }}" type="text" name="chargeable" id="chargeable" value="{{ old('chargeable', $order->chargeable) }}">
                @if($errors->has('chargeable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('chargeable') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.chargeable_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pieces">{{ trans('cruds.order.fields.pieces') }}</label>
                <input class="form-control {{ $errors->has('pieces') ? 'is-invalid' : '' }}" type="number" name="pieces" id="pieces" value="{{ old('pieces', $order->pieces) }}" step="1">
                @if($errors->has('pieces'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pieces') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.pieces_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pickup_date">{{ trans('cruds.order.fields.pickup_date') }}</label>
                <input class="form-control datetime {{ $errors->has('pickup_date') ? 'is-invalid' : '' }}" type="text" name="pickup_date" id="pickup_date" value="{{ old('pickup_date', $order->pickup_date) }}">
                @if($errors->has('pickup_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pickup_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.pickup_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="destination">{{ trans('cruds.order.fields.destination') }}</label>
                <input class="form-control {{ $errors->has('destination') ? 'is-invalid' : '' }}" type="text" name="destination" id="destination" value="{{ old('destination', $order->destination) }}">
                @if($errors->has('destination'))
                    <div class="invalid-feedback">
                        {{ $errors->first('destination') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.destination_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cash_on_delivery">{{ trans('cruds.order.fields.cash_on_delivery') }}</label>
                <input class="form-control {{ $errors->has('cash_on_delivery') ? 'is-invalid' : '' }}" type="number" name="cash_on_delivery" id="cash_on_delivery" value="{{ old('cash_on_delivery', $order->cash_on_delivery) }}" step="0.01">
                @if($errors->has('cash_on_delivery'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cash_on_delivery') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.cash_on_delivery_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.order.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $order->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="custom_value">{{ trans('cruds.order.fields.custom_value') }}</label>
                <input class="form-control {{ $errors->has('custom_value') ? 'is-invalid' : '' }}" type="number" name="custom_value" id="custom_value" value="{{ old('custom_value', $order->custom_value) }}" step="0.01">
                @if($errors->has('custom_value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('custom_value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.custom_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.order.fields.delivery_status') }}</label>
                <select class="form-control {{ $errors->has('delivery_status') ? 'is-invalid' : '' }}" name="delivery_status" id="delivery_status">
                    <option value disabled {{ old('delivery_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Order::DELIVERY_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('delivery_status', $order->delivery_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('delivery_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('delivery_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.delivery_status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.orders.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
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