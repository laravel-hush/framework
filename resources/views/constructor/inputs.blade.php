<div class="row">
    @foreach ($inputs as $input)

        @if (isset($input['condition']) && !call_user_func($input['condition'], get_defined_vars()))
            @continue
        @endif

        @if ($input['type'] == 'closure')
            <div class="col {{ $input['width'] ?? 'col-12' }}">
                {!! call_user_func($input['closure'], get_defined_vars()) !!}
            </div>
            @continue
        @endif

        @if ($input['type'] == 'html')
            <div class="col {{ $input['width'] ?? 'col-12' }}">
                {!! $input['html'] !!}
            </div>
            @continue
        @endif

        @if ($input['type'] == 'hidden')
            {!! Form::hidden($input['name'], Constructor::value(get_defined_vars(), $input, $input['default'] ?? null)) !!}
            @continue
        @endif

        @if ($input['type'] == 'view')
            <div class="col {{ $input['width'] ?? 'col-12' }}">
                @include ($input['view'])
            </div>
            @continue
        @endif

        <div class="col {{ $input['width'] ?? 'col-12' }}">

            @if (!in_array($input['type'], ['text-multilingual', 'textarea-multilingual']))
            <div class="form-group">
            @endif

                @if (isset($input['label']) && !in_array($input['type'], [
                    'checkbox', 'radion', 'text-multilingual', 'textarea-multilingual'
                ]))
                {!! Form::label($input['name'], __('hush::admin.' . $input['label'])
                    . (isset($input['lang']) ? " ({$langs[$input['lang']]->name})" : '')) !!}
                @endif

                @switch ($input['type'])

                    @case ('checkbox')
                        @include ('hush::components.inputs.checkbox', [
                            'name' => $input['name'],
                            'is_checked' => Constructor::value(get_defined_vars(), $input, $input['default'] ?? []),
                            'label' => isset($input['label'])
                                ? __('hush::admin.' . $input['label'])
                                : ''
                        ])
                        @break
                    
                    @case ('date')
                    @case ('datetime')
                    @case ('daterange')
                    @case ('datetimerange')
                        {!! Form::text($input['name'], Constructor::value(get_defined_vars(), $input, $input['default'] ?? null), [
                            'class' => "form-control {$input['type']}" . ($input['class'] ?? ''),
                            'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
                        ]) !!}
                        @break

                    @case ('file')
                        @include ('hush::components.inputs.file', [
                            'name' => $input['name'],
                            'value' => Constructor::value(get_defined_vars(), $input, $input['default'] ?? []),
                            'id' => $input['id'] ?? (isset($input['multiple']) ? null : $input['name']),
                            'multiple' => $input['multiple'] ?? null
                        ])
                        @break

                    @case ('password')
                        {!! Form::{$input['type']}($input['name'], [
                            'class' => 'form-control ' . ($input['class'] ?? ''),
                            'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
                        ]) !!}
                        @break

                    @case ('select')
                        @php(
                            $placeholder = !isset($input['multiple']) || !$input['multiple']
                                ? __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
                                : null
                        )
                        {!! Form::{$input['type']}(
                            $input['name'],
                            isset($input['data']) ? call_user_func($input['data'], get_defined_vars()) : [],
                            Constructor::value(get_defined_vars(), $input, $input['default'] ?? []),
                            [
                                'id' => $input['id'] ?? null,
                                'class' => 'form-control ' . ($input['class'] ?? ''),
                                'placeholder' => $placeholder,
                                'multiple' => $input['multiple'] ?? false,
                                'data-placeholder' => $placeholder
                            ]
                        ) !!}
                        @break

                    @case ('text-multilingual')
                    @case ('textarea-multilingual')
                        @include ("hush::components.inputs.{$input['type']}", [
                            'name' => $input['name'],
                            'values' => Constructor::value(get_defined_vars(), $input, $input['default'] ?? []),
                            'label' => $input['label'] ?? ''
                        ])
                        @break

                    @default
                        {!! Form::{$input['type']}($input['name'], Constructor::value(get_defined_vars(), $input, $input['default'] ?? null), array_merge([
                            'class' => 'form-control '
                                . ($input['class'] ?? '')
                                . (isset($input['slugify']) && !$model->id ? 'sluggable' : ''),
                            'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? '')),
                            'data-slugify-target' => $input['slugify'] ?? null,
                        ], $input['attributes'] ?? [])) !!}
                        @break

                @endswitch

                @isset ($input['description'])
                <small class="d-block">@lang ('hush::admin.' . $input['description'])</small>
                @endisset

            @if (!in_array($input['type'], ['text-multilingual', 'textarea-multilingual']))
            </div>
            @endif
        </div>

    @endforeach
</div>
