<div class="multilingual-input row no-gutters align-items-center">
    <div class="col">
        @foreach ($langs as $i => $lang)
        {!! Form::text($input['name'] . "[$lang->code]", Constructor::value(get_defined_vars(), $input, $input['default'] ?? []), [
            'class' => 'form-control multilingual-field ' . ($i != 0 ? 'd-none' : '') . ' ' . ($input['class'] ?? ''),
            'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
        ]) !!}
        @endforeach
    </div>
    <select class="col-2 multilingual-selector">
        @foreach ($langs as $lang)
        <option value="{{ $input['name'] }}[{{ $lang->code }}]">{{ $lang->name }}</option>
        @endforeach
    </select>
</div>