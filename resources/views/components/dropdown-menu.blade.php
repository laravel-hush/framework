@php ($subsize = $subsize ?? '')

<div class="dropdown-menu {{ $subsize }}submenu dropright" id="{{ $id }}">

    @foreach ($menu as $i => $subitem)

    <a href="{{ Constructor::link($subitem) }}" class="dropdown-item">

        @isset ($subitem['icon'])
        {!! $subitem['icon'] !!}
        @endisset

        <span class="col">@lang ('hush::admin.' . $subitem['text'])</span>

    </a>

    @endforeach

</div>
