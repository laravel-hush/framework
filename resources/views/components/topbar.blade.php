<nav class="horizontal-nav row no-gutters align-items-center justify-content-between with-margin" id="topbar">
    <a href="/" class="logo">
        <img src="{{ asset('vendor/hush/images/long-logo.png') }}" alt="">
    </a>
    <div class="navigation row no-gutters">
        <div class="navigation-item col notifications" id="dropdownNotifications" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">notifications</i>
        </div>
        <div class="dropdown-menu notifications-dropdown" aria-labelledby="dropdownNotifications">
            <div class="dropdown-item heading">Notifications</div>
            <a href="#" class="dropdown-item notification">
                <div class="icon-col">
                    <i class="material-icons">report</i>
                </div>
                <div class="col">
                    <p class="message">New report has been received</p>
                    <p class="time">23 hrs ago</p>
                </div>
            </a>
            <a href="#" class="dropdown-item notification">
                <div class="icon-col">
                    <i class="material-icons">notifications</i>
                </div>
                <div class="col">
                    <p class="message">New report has been received</p>
                    <p class="time">23 hrs ago</p>
                </div>
            </a>
        </div>
        <div class="user row no-gutters align-items-center">
            <div class="name">{{ auth()->user()->name }}</div>
            <div class="image">
                <img src="/vendor/hush/images/user-placeholder.jpg" class="rounded-circle">
            </div>
        </div>
    </div>
</nav>
