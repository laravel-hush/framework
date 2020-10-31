@if (in_array($type, ['file', 'text', 'textarea']) && $isMultilingual())

    @if ($isMultirow())
        @include("hush::components.inputs.multilingual.$type-multirow", ['langs' => $getLangs()])
    @else
        @include("hush::components.inputs.multilingual.$type", ['langs' => $getLangs()])
    @endif

@elseif (in_array($type, ['checkbox', 'radio', 'select', 'textarea']))

    @include("hush::components.inputs.$type")

@elseif ($type == 'file')

    @if ($isMultiple())
        @include('hush::components.inputs.file-multiple')
    @else
        @include('hush::components.inputs.file')
    @endif

@else

    @include('hush::components.inputs.input')

@endif
