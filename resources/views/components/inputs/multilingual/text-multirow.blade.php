<div class="row">
    @foreach ($langs as $i => $lang)
    <div class="form-group {{ $field_width }}">
        {!! Form::label($name . "[$lang->code]", __('hush::admin.' . $attributes['label']) . " ($lang->name)") !!}
        {!! Form::text($name . "[$lang->code]", $values[$lang->code] ?? '', [
            'class' => 'form-control multilingual-field '
                . ($slugify && $loop->first ? 'sluggable' : '') . ' '
                . ($attributes['class'] ?? ''),
                'placeholder' => __('hush::admin.' . ($attributes['placeholder'] ?? $attributes['label'] ?? '')),
                'data-slugify-target' => $loop->first && $slugify ? $slugify : null,
        ]) !!}
    </div>
    @endforeach
</div>