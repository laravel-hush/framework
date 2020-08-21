<div class="row">
    @foreach ($langs as $i => $lang)
    <div class="form-group {{ $getFieldWidth() }}">
        <label for="{{ $name . "[$lang->code]" }}">
            @lang('hush::admin.' . $attributes['label']) ({{ $lang->name }})
        </label>
        <x-hush-input
            type="textarea"
            :name="$name . '[' . $lang->code . ']'"
            :value="$value[$lang->code] ?? ''"
            :class="$getMultilingualClassAttribute()"
            :placeholder="$getPlaceholder()"
            :rows="$attributes['rows'] ?? 5"
            {{ $attributes->except('field-width', 'label', 'placeholder', 'multilingual', 'multirow', 'class', 'rows') }}/>
    </div>
    @endforeach
</div>
