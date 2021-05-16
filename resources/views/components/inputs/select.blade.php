@php ($options = $getSelectOptions())
<select name="{{ $name }}{{ $isMultiple() ? '[]' : '' }}"
    data-placeholder="{{ $getPlaceholder() }}"
    @if ($isMultiple()) multiple @endif
    {{ $attributes->except('options', 'multiple', 'label', 'placeholder') }}>

    @if (!$isMultiple())
        <option disabled>{{ $getPlaceholder() }}</option>
        <option value="">@lang('hush::admin.not-selected')</option>
    @endif

    @foreach ($options as $key => $text)
        <option value="{{ $key }}" @if ($isSelected($key)) selected @endif>{{ $text }}</option>
    @endforeach
</select>
