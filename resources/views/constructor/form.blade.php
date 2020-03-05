{!! Form::open([
    'method' => 'post',
    'url' => Constructor::link($block['content']),
    'id' => $block['content']['id'] ?? '',
    'class' => 'submitable'
]) !!}

@isset ($block['content']['grid'])
<div class="row">
    @foreach ($block['content']['grid'] as $column)
    <div class="col {{ $column['size'] }}">
        @include ('hush::constructor.inputs', ['inputs' => $column['inputs']])
    </div>
    @endforeach
</div>
@else
    @include ('hush::constructor.inputs', ['inputs' => $block['content']['inputs']])
@endisset

{!! Form::close() !!}
