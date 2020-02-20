@isset ($block['title'])
<div class="headline">

    @isset ($block['title']['text'])
    <span class="h1">@lang ('hush::admin.' . $block['title']['text'])</span>
    @endisset

    @isset ($block['title']['buttons'])
    <div class="buttons">

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

    </div>
    @endisset

</div>
@endisset
