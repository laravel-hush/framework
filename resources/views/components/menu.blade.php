<div class="with-margin" id="menu">
    <div class="nav mb-0">

        @foreach (config('hush.menu') as $i => $item)

        @php($link = Constructor::link($item))

        @if (!isset($item['permission']) || auth()->user()->permitted($item['permission']))

        <div class="nav-item">
            <a href="{{ $link }}"
                class="nav-link d-flex align-items-center {{ mb_strpos(request()->url(), $link) !== false ? 'active' : '' }}"
                @isset ($item['submenu'])
                    data-target="submenu-{{ $i }}"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                @endisset
                @isset ($item['in_new_tab'])
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
