<div class="table table-striped table-borderless">

    <div class="row head">

        @foreach ($block['content']['columns'] as $column => $settings)
        <div class="col {{ $column }} {{ $settings['class'] ?? '' }}">

            @isset ($settings['sortable'])
            <a href="{{ Constructor::link(['constructor' => collect(request()->except('sort', 'direction'))->merge([
                'sort' => $column,
                'direction' => $column == request()->sort && request()->direction == 'asc' ? 'desc' : 'asc'
            ])->all()]) }}" class="sortable-column d-flex align-items-center">
                @lang ('hush::admin.' . $column)
                @if (request()->sort == $column)
                <i class="material-icons">swap_vert</i>
                @endif
            </a>
            @else
            @lang ('hush::admin.' . $column)
            @endisset

        </div>
        @endforeach

        @isset ($block['content']['actions'])
        <div class="col actions">@lang ('hush::admin.actions')</div>
        @endisset

    </div>

    @php ($rows = $block['content']['rows']())

    @forelse ($rows as $row)
    <div class="row">

        @foreach ($block['content']['columns'] as $column => $settings)
        <div class="col {{ $column }} {{ $settings['class'] ?? '' }}">
            @switch ($settings['type'] ?? '')
                @case ('image')
                    <img src="{{ $row->{$column} }}" alt="">
                    @break
                @case ('closure')
                    {!! call_user_func($settings['content'], $row) !!}
                    @break
                @default
                    {{ $row->{$column} }}
                    @break
            @endswitch
        </div>
        @endforeach

        @isset ($block['content']['actions'])
        <div class="col actions">

            @foreach ($block['content']['actions'] as $action)

            @if (isset($action['condition']) && !call_user_func($action['condition'], get_defined_vars()))
                @continue
            @endif

            @if (!isset($action['permission']) || auth()->user()->permitted($action['permission']))
            <a href="{{ Constructor::link($action, get_defined_vars()) }}" class="btn btn-additional {{ isset($action['text']) ? 'btn-rounded' : 'btn-round' }}"
                @isset ($action['in_new_tab']) target="_blank" @endisset>
                <i class="material-icons">{{ $action['icon'] }}</i>
                @isset ($action['text'])
                <span>@lang ('hush::admin.' . $action['text'])</span>
                @endisset
            </a>
            @endif

            @endforeach

            @isset ($block['content']['edit'])
            @if (!is_string($block['content']['edit']) || auth()->user()->permitted($block['content']['edit']))
            <a href="{{ Constructor::link(['constructor' => [
                'url' => $baseUrl . '/edit',
                'id' => $row->id
            ]]) }}" class="btn btn-primary btn-round {{ isset($block['content']['modal']) ? 'in-modal' : '' }}">
                <i class="material-icons">edit</i>
            </a>
            @endif
            @endisset

            @isset ($block['content']['delete'])
            @if (!is_string($block['content']['delete']) || auth()->user()->permitted($block['content']['delete']))
            <a href="{{ Constructor::link(['constructor' => [
                'id' => $row->id,
                'action' => 'delete'
            ]]) }}" class="btn btn-danger btn-round delete-item">
                <i class="material-icons">delete</i>
            </a>
            @endif
            @endisset

        </div>
        @endisset

    </div>
    @empty
    <div class="row justify-content-center">
        <div>@lang ('hush::admin.no-data')</div>
    </div>
    @endforelse
</div>

<div class="pagination-block">
    @isset ($block['content']['pagination'])
    {!! $rows->appends(request()->except('page'))->render() !!}
    @endisset
</div>
