@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header bg-dark  text-center fs-3 text-bold text-warning">
        {{ trans('global.edit') }} {{ trans('cruds.userAlert.title_singular') }}
    </div>

    <div class="card-body bg-dark bg-gradient">
        <form method="POST" action="{{ route("admin.user-alerts.update", [$userAlert->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection