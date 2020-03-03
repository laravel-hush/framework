<div id="sidebar">
    <div class="user row no-gutters align-items-center">
        <div class="image col-2">
            <img src="/vendor/hush/images/user-placeholder.jpg">
        </div>
        <div class="col-10 pl-3 name">
            <a href="#">
                <span class="d-block">{{ auth()->user()->name }}</span>
                <small class="d-block text-secondary">
                    @lang ('hush::admin.my-profile')
                </small>
            </a>
        </div>
    </div>
    <div class="nav flex-column mb-0">
        @foreach (config('hush.menu') as $item)
        @if (!isset($item['permission']) || auth()->user()->permitted($item['permission']))
        <div class="nav-item">
            <a href="{{ Constructor::link($item) }}" class="nav-link d-flex align-items-center">
                <span class="d-flex align-items-center mr-3">{!! $item['icon'] !!}</span>
                <span>@lang ('hush::menus.' . $item['text'])</span>

                @isset ($item['counter'])
                <span class="counter"
                    style="@isset ($item['counter']['color']) background-color: {{ $item['counter']['color'] }} @endisset">
                    {!! call_user_func($item['counter']['value'] ?? '') !!}
                </span>
                @endisset

            </a>
        </div>
        @endif
        @endforeach
    </div>
</div>
