<div class="multilingual-input row no-gutters align-items-center">
    <div class="col">
        @foreach ($langs as $lang)
        {!! Form::text($name . "[$lang->code]", $values[$lang->code] ?? '', [
            'class' => 'form-control multilingual-field '
                . (!$loop->first ? 'd-none' : '') . ' '
                . ($isSluggable() && $loop->first ? 'sluggable' : '') . ' '
                . ($attributes['class'] ?? ''),
            'placeholder' => $getPlaceholder(),
            'data-slugify-target' => $isSluggable() && $loop->first ? $attributes['slugify'] : null,
        ]) !!}
        @endforeach
    </div>
    <select class="col-2 multilingual-selector">
        @foreach ($langs as $lang)
        <option value="{{ $name }}[{{ $lang->code }}]">{{ $lang->name }}</option>
        @endforeach
    </select>
</div>
