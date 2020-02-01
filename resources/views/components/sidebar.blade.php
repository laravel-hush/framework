@php
use ScaryLayer\Hush\Helpers\Code;
@endphp

<div id="sidebar">
    <div class="sitename">
        Hush admin
    </div>
    <div class="nav flex-column mb-0">
        @foreach (config('hush.menu') as $item)
        <div class="nav-item">
            <a href="#" class="nav-link d-flex align-items-center">
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