@isset ($breadcrumbs)
<ol class="breadcrumb mb-0">
    <li class="breadcrumb-item"><a href="/admin">@lang ('hush::admin.home')</a></li>

    @foreach ($breadcrumbs as $text => $link)

    @isset ($link)
    <li class="breadcrumb-item">
        <a href="{{ "/" . str_replace('.', '/', $link) }}">{{ $text }}</a>
    </li>
    @else
    <li class="breadcrumb-item active" aria-current="page">
        {{ $text }}
    </li>
    @endisset

    </li>
    @endforeach

</ol>
@endisset
