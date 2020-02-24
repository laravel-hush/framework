@isset ($block['title'])
<div class="headline">

    @isset ($block['title']['text'])
    <span class="h1">@lang ('hush::admin.' . $block['title']['text'])</span>
    @endisset

    <div class="buttons">
        @include ('hush::constructor.buttons')
    </div>

</div>
@endisset
