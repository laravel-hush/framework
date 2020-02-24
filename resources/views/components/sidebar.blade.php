<div id="sidebar">
    <div class="user row no-gutters align-items-center">
        <div class="image col-2">
            <img src="/vendor/hush/images/user-placeholder.jpg">
        </div>
        <div class="col-10 pl-3 name">
            <a href="#">{{ auth()->user()->name }}</a>
        </div>
    </div>
    <div class="nav flex-column mb-0">
        @foreach (config('hush.menu') as $item)
        <div class="nav-item">
            <a href="{{ Constructor::link($item) }}" class="nav-link d-flex align-items-center">
                <span class="d-flex align-items-center mr-3">{!! $item['icon'] !!}</span>
                <span>{{ $item['text'] }}</span>
                <span class="counter"
                    style="@isset ($item['counter']['color']) background-color: {{ $item['counter']['color'] }} @endisset">
                    {!! Code::execute($item['counter']['value'] ?? '') !!}
                </span>
            </a>
        </div>
        @endforeach
    </div>
</div>
