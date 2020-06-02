<div class="multilingual-input row no-gutters align-items-center">
    <div class="col">
        @foreach ($langs as $i => $lang)
        {!! Form::text($input['name'] . "[$lang->code]", $values[$lang->code] ?? '', [
            'class' => 'form-control multilingual-field '
                . ($i != 0 ? 'd-none' : '') . ' '
                . (isset($input['slugify']) && !$model->id ? 'sluggable' : '') . ' '
                . ($input['class'] ?? ''),
            'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? '')),
            'data-slugify-target' => $i == 0 ? ($input['slugify'] ?? null) : null,
        ]) !!}
        @endforeach
    </div>
    <select class="col-2 multilingual-selector">
        @foreach ($langs as $lang)
        <option value="{{ $input['name'] }}[{{ $lang->code }}]">{{ $lang->name }}</option>
        @endforeach
    </select>
</div>