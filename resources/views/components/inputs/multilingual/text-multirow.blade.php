<div class="row">
    @foreach ($langs as $i => $lang)
    <div class="form-group {{ $getFieldWidth() }}">

        @isset($attributes['label'])
        <label for="{{ $name . "[$lang->code]" }}">
            @lang('hush::admin.' . $attributes['label']) ({{ $lang->name }})
        </label>
        @endisset

        <input
            type="text"
            name="{{ $name . '[' . $lang->code . ']' }}"
            value="{{ $value[$lang->code] ?? '' }}"
            class="form-control {{ $getMultilingualClassAttribute() . ' '
                . ($isSluggable() && $loop->first && (!isset($model) || !$model->id) ? 'sluggable' : '') }}"
            placeholder="{{ $getPlaceholder() }} ({{ $lang->name }})"
            data-slugify-target="{{ $isSluggable() && $loop->first ? $attributes['slugify'] : null }}"
            {{ $attributes->except('field-width', 'label', 'slugify', 'placeholder', 'multilingual', 'multirow', 'class') }}/>
    </div>
    @endforeach
</div>
