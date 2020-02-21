{!! Form::open([
    'method' => 'post',
    'url' => Constructor::link($block['content']),
    'id' => $block['content']['id'] ?? '',
    'class' => 'submitable'
]) !!}

<div class="row">

    @foreach ($block['content']['inputs'] as $input)
    <div class="col {{ $input['width'] ?? 'col-12' }}">
        <div class="form-group">

            @isset ($input['label'])
            {!! Form::label($input['name'], __('hush::admin.' . $input['label'])) !!}
            @endisset

            @switch ($input['type'])

                @case ('select')
                    {!! Form::{$input['type']}(
                        $input['name'],
                        isset($input['data']) ? call_user_func($input['data']) : [],
                        Constructor::value(get_defined_vars(), $input, $input['default'] ?? []),
                        [
                            'class' => 'form-control',
                            'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
                        ]
                    ) !!}
                    @break

                @default
                    {!! Form::{$input['type']}($input['name'], Constructor::value(get_defined_vars(), $input, $input['default'] ?? null), [
                        'class' => 'form-control',
                        'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
                    ]) !!}
                    @break

            @endswitch

        </div>
    </div>
    @endforeach

</div>

{!! Form::close() !!}
