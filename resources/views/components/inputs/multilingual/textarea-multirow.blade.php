<div class="row">
    @foreach ($langs as $i => $lang)
    <div class="form-group {{ $getFieldWidth() }}">
        <label for="{{ $name . "[$lang->code]" }}">
            @lang('hush::admin.' . $attributes['label']) ({{ $lang->name }})
        </label>
        <x-hush-input
            type="textarea"
            :name="$name . '[' . $lang->code . ']'"
            :value="$values[$lang->code] ?? ''"
            :class="$getClassAttribute()"
            :placeholder="$getPlaceholder()"
            :rows="$attributes['rows'] ?? 5"/>
    </div>
    @endforeach
</div>
