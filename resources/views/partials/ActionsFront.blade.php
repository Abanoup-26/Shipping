@if ($view)
    <a class="btn btn-xs btn-primary" href="{{ route('client.' . $crudRoutePart . '.show', $row->id) }}">
        {{ trans('global.view') }}
    </a>
@endif

@if ($print)
    <a class="btn btn-xs btn-info" href="{{ route('client.' . $crudRoutePart . '.print', $row->id) }}" target="_blank">
        Print
    </a>
@endif
