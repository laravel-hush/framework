<nav class="horizontal-nav row no-gutters align-items-center justify-content-between with-margin" id="topbar">
    <a href="/" class="logo">
        <img src="{{ asset('vendor/hush/images/long-logo.png') }}" alt="">
    </a>
    <div class="navigation row no-gutters">
        <div class="navigation-item col notifications">
            <i class="material-icons">notifications</i>
        </div>
        <div class="user row no-gutters align-items-center">
            <div class="name">{{ auth()->user()->name }}</div>
            <div class="image">
                <img src="/vendor/hush/images/user-placeholder.jpg" class="rounded-circle">
            </div>
        </div>
    </div>
</nav>
