<div class="multilingual-textarea">
    <div class="row no-gutters justify-content-between align-items-center mb-1">
        <label for="{{ $name }}">
            @lang('hush::admin.' . $attributes['label'])
        </label>
        <select class="multilingual-selector float-right">
            @foreach ($langs as $lang)
            <option value="{{ $name }}[{{ $lang->code }}]">{{ $lang->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        @foreach ($langs as $i => $lang)
        <textarea
            name="{{ $name . '[' . $lang->code . ']' }}"
            class="form-control {{ $getMultilingualClassAttribute() . (!$loop->first ? 'd-none' : '') }}"
            placeholder="{{ $getPlaceholder() }}"
            rows="{{ $attributes['rows'] ?? 5 }}"
            {{ $attributes->except('field-width', 'label', 'placeholder', 'multilingual', 'multirow', 'class', 'rows') }}>

            {{ $value[$lang->code] ?? '' }}
        </textarea>
        @endforeach
    </div>
</div>
