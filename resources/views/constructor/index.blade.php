@extends ('hush::components.layouts.app')

@section ('content')
<div class="row no-gutters {{ $settings['class'] ?? '' }}">

    @foreach ($settings['blocks'] as $block)
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