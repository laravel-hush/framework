@extends ('hush::components.layouts.main')

@section ('body')
    @include ('hush::components.topbar')
    @include ('hush::components.menu')

    <div class="page-content with-margin" id="content">
        @include ('hush::components.breadcrumbs')
        @yield ('content')
    </div>

    @include ('hush::components.footer')

    <div id="modals"></div>

    <script>var __ = @json(__('hush::frontend'));</script>
    <script>var upload_file_route = '{{ route('admin.upload-wysiwyg-image', [], false) }}';</script>
    <script src="{{ asset('vendor/hush/js/app.js') }}"></script>
    @if (config('hush.app.scripts'))
        @foreach (config('hush.app.scripts') as $script)
            <script src="{{ asset($script) }}"></script>
        @endforeach
    @endif
    @stack ('js')
@endsection
