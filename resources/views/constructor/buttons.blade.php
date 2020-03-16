@isset ($block['title']['add'])
@if (!is_string($block['title']['add']) || auth()->user()->permitted($block['title']['add']))
<a href="{{ Constructor::link(['constructor' => $baseUrl . '/edit']) }}"
    class="btn btn-light {{ Arr::get($block, 'content.modal') ? 'in-modal' : '' }}">
    <i class="material-icons">add</i>
    <span>@lang ('hush::admin.add')</span>
</a>
@endif
@endisset

@isset ($block['title']['search'])
<a href="#" class="btn btn-light search-button">
    <i class="material-icons">search</i>
    <span>@lang ('hush::admin.search')</span>
</a>
@endisset

@isset ($block['title']['buttons'])
@foreach ($block['title']['buttons'] as $button)

@if (!isset($button['permission']) || auth()->user()->permitted($button['permission']))
@isset ($button['form'])
<button form="{{ $button['form'] ?? '' }}" class="submit btn {{ $button['class'] ?? 'btn-light' }}">
    <i class="material-icons">{{ $button['icon'] }}</i>
    <span>@lang ('hush::admin.' . $button['text'])</span>
</button>
@else
<a href="{{ Constructor::link($button) }}" class="btn {{ $button['class'] ?? 'btn-light' }}"
    @isset ($button['in_new_tab']) target="_blank" @endisset>
    <i class="material-icons">{{ $button['icon'] }}</i>
    <span>@lang ('hush::admin.' . $button['text'])</span>
</a>
@endisset
@endif

@endforeach
@endisset
