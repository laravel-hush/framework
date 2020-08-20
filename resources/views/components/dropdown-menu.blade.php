@php ($subsize = $subsize ?? '')
@php ($dropdownId = "$id-{$subsize}submenu-$i")

<div class="dropdown-menu dropdown-align-left no-margin {{ $subsize }}submenu" id="{{ $id }}">

    @foreach ($menu as $i => $subitem)

    @if (!isset($subitem['permission']) || auth()->user()->permitted($subitem['permission']))
    <a href="{{ Constructor::link($subitem['link'] ?? '#') }}" class="dropdown-item">
        @isset ($subitem['icon'])
        {!! $subitem['icon'] !!}
        @endisset

        <span class="col">@lang ('hush::admin.' . $subitem['text'])</span>
    </a>
    @endif

    @endforeach

</div>
