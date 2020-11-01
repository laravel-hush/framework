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
