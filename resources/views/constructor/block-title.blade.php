@isset ($block['title'])
<div class="headline">

    <span class="h1">@lang ('admin.' . $block['title'])</span>

    @isset ($block['buttons'])
    <div class="buttons">

        @foreach ($block['buttons'] as $button)
        <a href="{{ Constructor::link($button) }}" class="btn {{ $button['class'] ?? 'btn-light' }}">
            <i class="material-icons">{{ $button['icon'] }}</i>
            <span>@lang ('admin.' . $button['text'])</span>
        </a>
        @endforeach

    </div>
    @endisset

</div>
@endisset