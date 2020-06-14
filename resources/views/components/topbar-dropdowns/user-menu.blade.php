<div class="dropdown-menu user-menu-dropdown submenu dropdown-align-right no-margin" id="dropdown-user-menu">
    <a href="#" class="dropdown-item">
        <i class="material-icons">account_circle</i>
        <span class="col">
            <span>@lang('hush::admin.profile')</span><br>
        </span>
    </a>
    <a href="{{ route('admin.logout') }}" class="dropdown-item danger">
        <i class="material-icons">exit_to_app</i>
        <span class="col">@lang('hush::admin.logout')</span>
    </a>
</div>