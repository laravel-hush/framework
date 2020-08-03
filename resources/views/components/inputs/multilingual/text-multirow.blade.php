<div class="row">
    @foreach ($langs as $i => $lang)
    <div class="form-group {{ $getFieldWidth() }}">
        {!! Form::label($name . "[$lang->code]", __('hush::admin.' . $attributes['label']) . " ($lang->name)") !!}
        {!! Form::text($name . "[$lang->code]", $values[$lang->code] ?? '', [
            'class' => 'form-control multilingual-field '
                . ($isSluggable() && $loop->first ? 'sluggable' : '') . ' '
                . ($attributes['class'] ?? ''),
                'placeholder' => $getPlaceholder(),
                'data-slugify-target' => $isSluggable() && $loop->first ? $attributes['slugify'] : null,
        ]) !!}
    </div>
    @endforeach
</div>