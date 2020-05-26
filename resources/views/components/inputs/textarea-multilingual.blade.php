<div class="multilingual-textarea">
    <div class="row no-gutters justify-content-between align-items-center mb-1">
        {!! Form::label($input['name'], __('hush::admin.' . $input['label'])) !!}
        <select class="multilingual-selector float-right">
            @foreach ($langs as $lang)
            <option value="{{ $input['name'] }}[{{ $lang->code }}]">{{ $lang->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        @foreach ($langs as $i => $lang)
        {!! Form::textarea($input['name'] . "[$lang->code]", $values[$lang->code] ?? '', [
            'class' => 'form-control multilingual-field ' . ($i != 0 ? 'd-none' : '') . ' ' . ($input['class'] ?? ''),
            'placeholder' => __('hush::admin.' . ($input['placeholder'] ?? $input['label'] ?? ''))
        ]) !!}
        @endforeach
    </div>
</div>