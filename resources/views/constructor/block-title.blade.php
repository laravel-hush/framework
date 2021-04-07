@isset ($block['title'])
<div class="headline row no-gutters w-100">

    @isset ($block['title']['text'])
        @if ($block['title']['text'] instanceof Closure)
            <span class="h1 col-4">{{ $block['title']['text'](get_defined_vars()) }}</span>
        @else
            <span class="h1 col-4">@lang ('hush::admin.' . $block['title']['text'])</span>
        @endif
    @endisset

    <x-hush-form id="search-form" class="search-form col-4">
        @isset ($block['title']['search'])
            <x-hush-input
                type="text"
                name="search"
                :placeholder="__('hush::admin.search-query')"
                :value="request()->search">
            </x-hush-input>
            <div class="button close-button cleaner" data-target="input[name=search]">
                <i class="material-icons">close</i>
            </div>
            <button type="submit" class="button">
                <i class="material-icons">search</i>
            </button>
        @endisset
    </x-hush-form>

    <div class="buttons col-4">
        @include ('hush::constructor.buttons')
    </div>

</div>
@endisset
