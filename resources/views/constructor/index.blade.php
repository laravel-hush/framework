@extends ('hush::components.layouts.app')

@section ('content')
<div class="row">

    @foreach ($settings['blocks'] as $block)
    <div class="col {{ isset($block['width']) ? 'col-' . $block['width'] : '' }}">
        <div class="block">

            @include ('hush::constructor.block-title')
            @include ('hush::constructor.' . $block['type'])

        </div>
    </div>
    @endforeach

</div>
@endsection