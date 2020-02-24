@isset ($block['title']['add'])
<a href="{{ Constructor::link(['constructor' => $baseUrl . '/edit']) }}"
    class="btn btn-light {{ Arr::get($block, 'content.modal') ? 'in-modal' : '' }}">
    <i class="material-icons">add</i>
    <span>@lang ('hush::admin.add')</span>
</a>
@endisset

@isset ($block['title']['buttons'])
@foreach ($block['title']['buttons'] as $button)

@isset ($button['form'])
<button form="{{ $button['form'] ?? '' }}" class="submit btn {{ $button['class'] ?? 'btn-light' }}">
    <i class="material-icons">{{ $button['icon'] }}</i>
    <span>@lang ('hush::admin.' . $button['text'])</span>
</button>
@else
<a href="{{ Constructor::link($button) }}" class="btn {{ $button['class'] ?? 'btn-light' }}">
    <i class="material-icons">{{ $button['icon'] }}</i>
    <span>@lang ('hush::admin.' . $button['text'])</span>
</a>
@endisset

@endforeach
@endisset
