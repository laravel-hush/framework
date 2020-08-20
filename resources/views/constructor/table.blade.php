<form>
    <table class="table">

        <thead class="head">

            <tr>
                @if (!isset($block['content']['checkboxes']) || $block['content']['checkboxes'])
                <th class="check-td">
                    <x-hush-input type="checkbox" name="all-checker" :checked="false"/>
                </th>
                @endif

                @foreach ($block['content']['columns'] as $column => $settings)
                <th class="align-middle {{ $column }} {{ $settings['class'] ?? '' }}">

                    @isset ($settings['sortable'])
                    <a href="{{ Constructor::link(function () use ($column) {
                        return collect(request()->except('sort', 'direction'))
                            ->merge([
                                'type' => 'page',
                                'name' => request()->url(),
                                'sort' => $column,
                                'direction' => $column == request()->sort && request()->direction == 'asc' ? 'desc' : 'asc'
                            ])
                            ->all();
                    }) }}" class="sortable-column d-flex align-items-center">
                        @lang ('hush::admin.' . ($settings['label'] ?? $column))
                        @if (request()->sort == $column)
                        <i class="material-icons">swap_vert</i>
                        @endif
                    </a>
                    @else
                    @lang ('hush::admin.' . ($settings['label'] ?? $column))
                    @endisset

                </th>
                @endforeach

                @isset ($block['content']['actions'])
                <th class="align-middle actions">@lang ('hush::admin.actions')</th>
                @endisset
            </tr>

        </thead>

        @php ($rows = call_user_func($block['content']['rows'], get_defined_vars()))

        <tbody>
            @forelse ($rows as $row)
            <tr class="table-row">

                @if (!isset($block['content']['checkboxes']) || $block['content']['checkboxes'])
                <td class="check-td">
                    <x-hush-input type="checkbox" name="items[]" :checked="false" :value="$row->id"/>
                </td>
                @endif

                @foreach ($block['content']['columns'] as $column => $settings)
                <td class="align-middle {{ $column }} {{ $settings['class'] ?? '' }}">
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
                </td>
                @endforeach

                @isset ($block['content']['actions'])
                <td class="align-middle actions">

                    @foreach ($block['content']['actions'] as $action)

                    @if (isset($action['condition']) && !call_user_func($action['condition'], get_defined_vars()))
                        @continue
                    @endif

                    @if (!isset($action['permission']) || auth()->user()->permitted($action['permission']))
                    <a href="{{ Constructor::link($action['link'] ?? '#', get_defined_vars()) }}"
                        class="btn btn-additional {{ isset($action['text']) ? 'btn-rounded' : 'btn-round' }}"
                        @isset ($action['in-new-tab']) target="_blank" @endisset>
                        <i class="material-icons">{{ $action['icon'] }}</i>
                        @isset ($action['text'])
                        <span>@lang ('hush::admin.' . $action['text'])</span>
                        @endisset
                    </a>
                    @endif

                    @endforeach

                    @isset ($block['content']['edit'])
                    @if (!is_string($block['content']['edit']) || auth()->user()->permitted($block['content']['edit']))
                    <a href="{{ Constructor::link("page:$baseUrl.edit|id:$row->id") }}"
                        class="btn btn-primary btn-round @isset($block['content']['modal']) in-modal @endisset">
                        <i class="material-icons">edit</i>
                    </a>
                    @endif
                    @endisset

                    @isset ($block['content']['delete'])
                    @if (!is_string($block['content']['delete']) || auth()->user()->permitted($block['content']['delete']))
                    <a href="{{ Constructor::link("action:delete|id:$row->id") }}"
                        class="btn btn-danger btn-round delete-item">
                        <i class="material-icons">delete</i>
                    </a>
                    @endif
                    @endisset

                </td>
                @endisset

            </tr>
            @empty
            <tr class="table-row justify-content-center">
                <td colspan="100" class="text-center">@lang ('hush::admin.no-data')</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</form>

@isset ($block['content']['multiple-actions'])
<div class="multiple-actions-block" style="display: none">
    @foreach ($block['content']['multiple-actions'] as $action)
    <a href="{{ Constructor::link($action['link'] ?? '#') }}" data-request_type="{{ $action['type'] }}"
        class="btn btn-danger {{ $action['confirmation'] ? 'with-confirmation' : '' }}">
        @lang('hush::admin.' . $action['text'])
    </a>
    @endforeach
</div>
@endisset

@if (isset($block['content']['pagination']) && $rows->hasPages())
<div class="pagination-block">
    {!! $rows->appends(request()->except('page'))->render() !!}
</div>
@endif
