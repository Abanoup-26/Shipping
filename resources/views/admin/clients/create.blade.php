@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.client.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clients.store") }}" enctype="multipart/form-data">
            @csrf
            <!--- User_id -->
            <div class="form-group">
                
                <label class="required" for="user_id">{{ trans('cruds.client.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.user_helper') }}</span>
            </div>
            <!--- company_name -->
            <div class="form-group">
                <label class="required" for="company_name">{{ trans('cruds.client.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}" required>
                @if($errors->has('company_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.company_name_helper') }}</span>
            </div>
             <!--- shop_name -->
            <div class="form-group">
                <label class="required" for="shop_name">{{ trans('cruds.client.fields.shop_name') }}</label>
                <input class="form-control {{ $errors->has('shop_name') ? 'is-invalid' : '' }}" type="text" name="shop_name" id="shop_name" value="{{ old('shop_name', '') }}" required>
                @if($errors->has('shop_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shop_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.shop_name_helper') }}</span>
            </div>
             <!--- commerical_record -->
            <div class="form-group">
                <label class="required" for="commerical_record">{{ trans('cruds.client.fields.commerical_record') }}</label>
                <div class="needsclick dropzone {{ $errors->has('commerical_record') ? 'is-invalid' : '' }}" id="commerical_record-dropzone">
                </div>
                @if($errors->has('commerical_record'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commerical_record') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.commerical_record_helper') }}</span>
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
    success: function (file, response) {
      $('form').find('input[name="commerical_record"]').remove()
      $('form').append('<input type="hidden" name="commerical_record" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="commerical_record"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
    @if(isset($client) && $client->commerical_record)
      var file = {!! json_encode($client->commerical_record) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="commerical_record" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
    @endif
    },
     error: function (file, response) {
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