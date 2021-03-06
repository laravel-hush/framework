@isset ($block['title']['add'])
    @if (!is_string($block['title']['add']) || auth()->user()->permitted($block['title']['add']))
        <a href="{{ Constructor::link("page:$baseUrl.edit") }}"
            class="btn btn-light {{ Arr::get($block, 'content.modal') ? 'in-modal' : '' }}">
            <i class="material-icons">add</i>
            <span>@lang ('hush::admin.add')</span>
        </a>
    @endif
@endisset

@isset ($block['title']['buttons'])
    @foreach ($block['title']['buttons'] as $button)

        @if (isset($button['condition']) && !call_user_func($button['condition'], get_defined_vars()))
            @continue
        @endif

        @if (!isset($button['permission']) || auth()->user()->permitted($button['permission']))
            @isset ($button['form'])
                <button form="{{ $button['form'] ?? '' }}" class="submit btn {{ $button['class'] ?? 'btn-light' }}">
                    <i class="material-icons">{{ $button['icon'] }}</i>
                    <span>@lang ('hush::admin.' . $button['text'])</span>
                </button>
            @else
                <a href="{{ Constructor::link($button['link'] ?? '#', get_defined_vars()) }}" class="btn {{ $button['class'] ?? 'btn-light' }}"
                    @isset ($button['in-new-tab']) target="_blank" @endisset>
                    <i class="material-icons">{{ $button['icon'] }}</i>
                    <span>@lang ('hush::admin.' . $button['text'])</span>
                </a>
            @endisset
        @endif

    @endforeach
@endisset

@isset ($block['title']['search'])
    <x-hush-form id="search-form" class="search-form">
        <x-hush-input
            type="text"
            name="search"
            :placeholder="__('hush::admin.search-query')"
            :value="request()->search">
        </x-hush-input>
        <button class="button">
            <i class="material-icons">search</i>
        </button>
    </x-hush-form>
@endisset
