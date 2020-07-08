<nav class="horizontal-nav row no-gutters align-items-center justify-content-between with-margin" id="topbar">
    <a href="/" class="logo">
        <img src="{{ asset('vendor/hush/images/long-logo.png') }}" alt="">
    </a>
    <div class="navigation row no-gutters">

        @foreach (config('hush.topbar-menu') as $item)

        <div class="navigation-item col notifications"
            @if ($item['has_dropdown']) data-dropdown="#dropdown-{{ $item['name'] }}" @endif>
            {!! $item['icon'] ?? '' !!}
        </div>

        @if ($item['has_dropdown'])
        <div class="dropdown-menu notifications-dropdown" id="dropdown-{{ $item['name'] }}">
            @include($item['view'])
        </div>
        @endif

        @endforeach

        <div class="user row no-gutters align-items-center" data-dropdown="#dropdown-user-menu">
            <div class="name">{{ auth()->user()->name }}</div>
            <div class="image">
                <img src="/vendor/hush/images/user-placeholder.jpg" class="rounded-circle">
            </div>
        </div>
        @include('hush::components.topbar-dropdowns.user-menu')
    </div>
</nav>
