<div class="row">
    @foreach ($langs as $i => $lang)
    <div class="form-group {{ $getFieldWidth() }}">
        <label for="{{ $name . "[$lang->code]" }}">
            @lang('hush::admin.' . $attributes['label']) ({{ $lang->name }})
        </label>
        <x-hush-input
            type="text"
            :name="$name . '[' . $lang->code . ']'"
            :value="$value[$lang->code] ?? ''"
            :class="$getMultilingualClassAttribute() . ' ' . ($isSluggable() && $loop->first ? 'sluggable' : '')"
            :placeholder="$getPlaceholder()"
            :data-slugify-target="$isSluggable() && $loop->first ? $attributes['slugify'] : null"/>
    </div>
    @endforeach
</div>