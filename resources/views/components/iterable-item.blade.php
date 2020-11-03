@php
$prefix = $input['name'] . '[' . ($i ?? '${i}') . ']';
$variables = get_defined_vars();
$variables['model'] = $item;
@endphp

<div class="row iterable-item justify-content-center align-items-center">

    <input type="hidden" name="{{ $prefix }}[id]" value="{{ isset($item) ? $item->id : '' }}">

    @foreach ($input['inputs'] as $subinput)

        @php
        $subinput['value'] = Constructor::value($variables, $subinput, $subinput['default'] ?? null);
        $subinput['name'] = $prefix . "[{$subinput['name']}]";
        @endphp

        @if (isset($subinput['condition']) && !call_user_func($subinput['condition'], get_defined_vars()))
            @continue
        @endif

        @if ($subinput['type'] == 'closure')
            <div class="col {{ $subinput['width'] ?? 'col-12' }}">
                {!! call_user_func($subinput['closure'], get_defined_vars()) !!}
            </div>
            @continue
        @endif

        @if ($subinput['type'] == 'html')
            <div class="col {{ $subinput['width'] ?? 'col-12' }}">
                {!! $subinput['html'] !!}
            </div>
            @continue
        @endif

        @if ($subinput['type'] == 'hidden')
            <x-hush-input
                type="hidden"
                :name="$subinput['name']"
                :value="Constructor::value(get_defined_vars(), $subinput, $subinput['default'] ?? null)"/>
            @continue
        @endif

        @if ($subinput['type'] == 'view')
            <div class="col {{ $subinput['width'] ?? 'col-12' }}">
                @include ($subinput['view'])
            </div>
            @continue
        @endif

        <div class="col {{ $subinput['width'] ?? null }}">
            {!! Input::render($subinput, $variables) !!}
        </div>

    @endforeach

    <div class="col-sm-12 col-lg-2 col-xl-2 d-flex justify-content-end">
        <button class="btn btn-danger delete-{{ $input['name'] }}">
            @lang('hush::admin.delete')
        </button>
    </div>

</div>
