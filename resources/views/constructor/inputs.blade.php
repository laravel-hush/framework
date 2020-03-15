<div class="row">
    @foreach ($inputs as $input)

        @if (isset($input['condition']) && !call_user_func($input['condition'], get_defined_vars()))
            @continue
        @endif

        @if ($input['type'] == 'hidden')
            {!! Form::hidden($input['name'], Constructor::value(get_defined_vars(), $input, $input['default'] ?? null)) !!}
            @continue
        @endif

        <div class="col {{ $input['width'] ?? 'col-12' }}">
            <div class="form-group">

                @isset ($input['label'])
                {!! Form::label($input['name'], __('hush::admin.' . $input['label'])) !!}
                @endisset

                @switch ($input['type'])

                    @case ('file')
                        @include ('hush::components.inputs.file', [
                            'name' => $input['name'],
                            'value' => Constructor::value(get_defined_vars(), $input, $input['default'] ?? []),
                            'id' => $input['id'] ?? $input['name']
                        ])
                        @break

                    @case ('select')
                        {!! Form::{$input['type']}(
                            $input['name'],
                            isset($input['data']) ? call_user_func($input['data']) : [],
                            Constructor::value(get_defined_vars(), $input, $input['default'] ?? []),
                            [
                                'class' => 'form-control ' . ($input['class'] ?? ''),
                                'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
                            ]
                        ) !!}
                        @break

                    @default
                        {!! Form::{$input['type']}($input['name'], Constructor::value(get_defined_vars(), $input, $input['default'] ?? null), [
                            'class' => 'form-control ' . ($input['class'] ?? ''),
                            'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
                        ]) !!}
                        @break

                @endswitch

                @isset ($input['description'])
                <small class="d-block">@lang ('hush::admin.' . $input['description'])</small>
                @endisset

            </div>
        </div>

    @endforeach
</div>
