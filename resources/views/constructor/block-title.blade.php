@isset ($block['title'])
<div class="headline">

    @isset ($block['title']['text'])
        @if ($block['title']['text'] instanceof Closure)
            <span class="h1">{{ $block['title']['text'](get_defined_vars()) }}</span>
        @else
            <span class="h1">@lang ('hush::admin.' . $block['title']['text'])</span>
        @endif
    @endisset

    <div class="buttons">
        @include ('hush::constructor.buttons')
    </div>

</div>
@endisset
