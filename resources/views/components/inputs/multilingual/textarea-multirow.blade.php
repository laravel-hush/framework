<div class="row">
    @foreach ($langs as $i => $lang)
    <div class="form-group {{ $getFieldWidth() }}">
        <label for="{{ $name . "[$lang->code]" }}">
            @lang('hush::admin.' . $attributes['label']) ({{ $lang->name }})
        </label>
        <textarea
            name="{{ $name . '[' . $lang->code . ']' }}"
            class="form-control {{ $getMultilingualClassAttribute() }}"
            placeholder="{{ $getPlaceholder() }}"
            rows="{{ $attributes['rows'] ?? 5 }}"
            {{ $attributes->except('field-width', 'label', 'placeholder', 'multilingual', 'multirow', 'class', 'rows') }}>

            {{ $value[$lang->code] ?? '' }}
        </textarea>
    </div>
    @endforeach
</div>
