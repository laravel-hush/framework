@php ($subsize = $subsize ?? '')
@php ($dropdownId = "$id-{$subsize}submenu-$i")

<div class="dropdown-menu dropdown-align-left no-margin {{ $subsize }}submenu" id="{{ $id }}">

    @foreach ($menu as $i => $subitem)

    <a href="{{ Constructor::link($subitem) }}" class="dropdown-item">
        @isset ($subitem['icon'])
        {!! $subitem['icon'] !!}
        @endisset

        <span class="col">@lang ('hush::admin.' . $subitem['text'])</span>
    </a>

    @endforeach

</div>
