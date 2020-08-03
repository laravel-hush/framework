<div class="multilingual-input row no-gutters align-items-center">
    <div class="col">
        @foreach ($langs as $lang)
        <x-hush-input
            type="text"
            :name="$name . '[' . $lang->code . ']'"
            :value="$values[$lang->code] ?? ''"
            :class="$getClassAttribute() . ' '
                . (!$loop->first ? 'd-none' : '') . ' '
                . ($isSluggable() && $loop->first ? 'sluggable' : '')"
            :placeholder="$getPlaceholder()"
            :data-slugify-target="$isSluggable() && $loop->first ? $attributes['slugify'] : null"/>
        @endforeach
    </div>
    <select class="col-2 multilingual-selector">
        @foreach ($langs as $lang)
        <option value="{{ $name }}[{{ $lang->code }}]">{{ $lang->name }}</option>
        @endforeach
    </select>
</div>
