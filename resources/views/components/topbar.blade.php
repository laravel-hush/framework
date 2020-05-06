<nav class="horizontal-nav row no-gutters align-items-center justify-content-between with-margin" id="topbar">
    <a href="/" class="logo">Hush</a>
    <div class="navigation">
        <div class="user row no-gutters align-items-center rounded-pill">
            <div class="name">{{ auth()->user()->name }}</div>
            <div class="image">
                <img src="/vendor/hush/images/user-placeholder.jpg" class="rounded-circle">
            </div>
        </div>
    </div>
</nav>
