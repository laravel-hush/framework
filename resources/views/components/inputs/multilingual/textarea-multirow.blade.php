<div class="row">
    @foreach ($langs as $i => $lang)
    <div class="form-group {{ $field_width }}">
        {!! Form::label($name . "[$lang->code]", __('hush::admin.' . $attributes['label']) . " ($lang->name)") !!}
        {!! Form::textarea($name . "[$lang->code]", $values[$lang->code] ?? '', [
            'class' => 'form-control multilingual-field ' . ' ' . ($attributes['class'] ?? ''),
            'placeholder' => __('hush::admin.' . ($attributes['placeholder'] ?? $attributes['label'] ?? '')) . " ($lang->name)"
        ]) !!}
    </div>
    @endforeach
</div>
