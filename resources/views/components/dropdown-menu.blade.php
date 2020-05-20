@php ($sub_size = $sub_size ?? '')

<div class="dropdown-menu {{ $sub_size }}submenu dropright">
    @foreach ($menu as $subitem)
    <a href="{{ Constructor::link($subitem) }}" class="dropdown-item"
        @isset ($subitem['submenu']) data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endisset>
        <span>@lang ('hush::admin.' . $subitem['text'])</span>
        @isset ($subitem['submenu'])
        <i class="material-icons expand-left">navigate_next</i>
        @include ('hush::components.dropdown-menu', ['sub_size' => $sub_size . 'sub'])
        @endisset
    </a>
    @endforeach
</div>
