<div class="row">
    @foreach ($langs as $i => $lang)
    <div class="form-group {{ $getFieldWidth() }}">

        @isset($attributes['label'])
        <label for="{{ $name . "[$lang->code]" }}">
            @lang('hush::admin.' . $attributes['label']) ({{ $lang->name }})
        </label>
        @endisset

        <textarea
            name="{{ $name . '[' . $lang->code . ']' }}"
            class="form-control {{ $getMultilingualClassAttribute() }}"
            placeholder="{{ $getPlaceholder() }} ({{ $lang->name }})"
            rows="{{ $attributes['rows'] ?? 5 }}"
            {{ $attributes->except('field-width', 'label', 'placeholder', 'multilingual', 'multirow', 'class', 'rows') }}
            >{{ $value[$lang->code] ?? '' }}</textarea>
    </div>
    @endforeach
</div>
