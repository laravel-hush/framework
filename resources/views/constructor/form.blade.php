{!! Form::open(['url' => Constructor::link($block)]) !!}

<div class="row">
@foreach ($block['inputs'] as $input)

    @switch ($input['type'])

        @case ('select')
            <div class="col col-{{ $input['width'] ?? 12 }}">
                <div class="form-group">
                    {!! Form::label($input['name'], __('admin.' . $input['label'])) !!}
                    {!! Form::{$input['type']}($input['name'], isset($input['data']) ? $input['data']() : [], $input['value'] ?? '', [
                    'class' => 'form-control',
                    'placeholder' => __('admin.' . ($input['placeholder'] ?? $input['label']))
                    ]) !!}
                </div>
            </div>
            @break

        @default
            <div class="col col-{{ $input['width'] ?? 12 }}">
                <div class="form-group">
                    {!! Form::label($input['name'], __('admin.' . $input['label'])) !!}
                    {!! Form::{$input['type']}($input['name'], $input['value'] ?? '', [
                        'class' => 'form-control',
                        'placeholder' => __('admin.' . ($input['placeholder'] ?? $input['label']))
                    ]) !!}
                </div>
            </div>
            @break

    @endswitch
@endforeach
</div>

{!! Form::close() !!}