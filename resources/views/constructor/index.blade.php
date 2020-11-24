@extends ('hush::components.layouts.app')

@section ('content')
<div class="row {{ $settings['class'] ?? '' }}">

    @foreach ($settings['blocks'] as $block)

        @if (isset($block['condition']) && !call_user_func($block['condition'], get_defined_vars()))
            @continue
        @endif

        <div class="col {{ $block['class'] ?? 'col-12' }}">
            <div class="block">

                @include ('hush::constructor.block-title')

                @isset ($block['content'])
                    @include ('hush::constructor.' . $block['content']['type'])
                @endisset

            </div>
        </div>
    @endforeach
</div>
@endsection

@push ('js')
    @include('hush::constructor.scripts')
@endpush
