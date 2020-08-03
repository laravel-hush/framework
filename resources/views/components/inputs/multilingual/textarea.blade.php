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
        <x-hush-input
            type="textarea"
            :name="$name . '[' . $lang->code . ']'"
            :value="$values[$lang->code] ?? ''"
            :class="$getClassField() . (!$loop->first ? 'd-none' : '')"
            :placeholder="$getPlaceholder()"/>
        @endforeach
    </div>
</div>
