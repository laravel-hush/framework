@extends ('hush::components.layouts.main')

@section ('body')
    @include ('hush::components.topbar')
    <nav class="left-side dark shadow-sm">
        @include ('hush::components.sidebar')
    </nav>

    <div class="right-side">
        <div class="page-content" id="content">
            @yield ('content')
        </div>
        <div id="modals"></div>
    </div>

    <script src="{{ asset('vendor/hush/js/app.js') }}"></script>
    @stack ('js')
@endsection
