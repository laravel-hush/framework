<div class="with-margin" id="menu">
    <div class="nav mb-0">

        @foreach (config('hush.menu') as $i => $item)

        @if (!isset($item['permission']) || auth()->user()->permitted($item['permission']))

        <div class="nav-item">
            <a href="{{ Constructor::link($item['link'] ?? '#') }}"
                class="nav-link d-flex align-items-center {{ Constructor::isMenuItemActive($item) ? 'active' : '' }}"
                @isset ($item['submenu'])
                    data-dropdown="#submenu-{{ $i }}"
                @endisset
                @isset ($item['in-new-tab'])
                    target="_blank"
                @endisset>

                <span>@lang('hush::admin.' . $item['text'])</span>

                @isset ($item['counter'])
                <span class="counter"
                    style="@isset ($item['counter']['color']) background-color: {{ $item['counter']['color'] }} @endisset">
                    {!! call_user_func($item['counter']['value'] ?? '') !!}
                </span>
                @endisset

                @isset ($item['submenu'])
                <i class="material-icons">expand_more</i>
                @endisset

            </a>

            @isset ($item['submenu'])
            @include ('hush::components.dropdown-menu', [
                'menu' => $item['submenu'],
                'id' => "submenu-$i"
            ])
            @endisset

        </div>

        @endif

        @endforeach

    </div>
</div>
