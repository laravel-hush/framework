<div class="multilingual-textarea">
    <div class="row no-gutters justify-content-between align-items-center mb-1">
        {!! Form::label($name, __('hush::admin.' . $attributes['label'])) !!}
        <select class="multilingual-selector float-right">
            @foreach ($langs as $lang)
            <option value="{{ $name }}[{{ $lang->code }}]">{{ $lang->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        @foreach ($langs as $i => $lang)
        {!! Form::textarea($name . "[$lang->code]", $values[$lang->code] ?? '', [
            'class' => 'form-control multilingual-field ' . (!$loop->first ? 'd-none' : '') . ' ' . ($attributes['class'] ?? ''),
            'placeholder' =>$getPlaceholder()
        ]) !!}
        @endforeach
    </div>
</div>
