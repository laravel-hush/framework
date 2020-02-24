<nav class="horizontal-nav row no-gutters align-items-center" id="topbar">
    <i class="material-icons mx-3" id="sidebar-toggle">menu</i>
    <nav aria-label="breadcrumb">
        @isset ($breadcrumbs)
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/admin">@lang ('hush::admin.home')</a></li>

            @foreach ($breadcrumbs as $text => $link)

            @isset ($link)
            <li class="breadcrumb-item">
                <a href="{{ $link }}">{{ $text }}</a>
            </li>
            @else
            <li class="breadcrumb-item active" aria-current="page">
                {{ $text }}
            </li>
            @endif

            </li>
            @endforeach

        </ol>
        @endisset
    </nav>
    <div class="col d-flex align-items-center justify-content-end">
        <i class="material-icons mr-3" id="notifications-toggle">notifications</i>
    </div>
</nav>
