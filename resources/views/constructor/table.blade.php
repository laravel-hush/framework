<div class="table table-striped table-borderless">

    <div class="row head">

        @foreach ($block['columns'] as $column => $settings)
        <div class="col {{ $column }}">@lang ('admin.' . $column)</div>
        @endforeach

        <div class="col actions">@lang ('admin.actions')</div>

    </div>

    @php ($rows = $block['rows']())

    @foreach ($rows as $row)
    <div class="row">

        @foreach ($block['columns'] as $column => $settings)
        <div class="col {{ $column }}">{{ $row->{$column} }}</div>
        @endforeach

        @isset ($block['actions'])
        <div class="col actions">
            
            @foreach ($block['actions'] as $action)
            <a href="{{ Constructor::link($action) }}" class="btn btn-additional btn-rounded">
                <i class="material-icons">{{ $action['icon'] }}</i>
                @isset ($action['text'])
                <span>@lang ('admin.' . $action['text'])</span>
                @endisset
            </a>
            @endforeach

            @isset ($block['edit'])
            <a href="#" class="btn btn-primary btn-round">
                <i class="material-icons">edit</i>
            </a>
            @endisset

            @isset ($block['delete'])
            <a href="#" class="btn btn-danger btn-round delete-item">
                <i class="material-icons">delete</i>
            </a>
            @endisset

        </div>
        @endisset

    </div>
    @endforeach
</div>