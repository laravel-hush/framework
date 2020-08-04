@php ($options = $getSelectOptions())
<select name="{{ $name }}"
    @if (!$isMultiple())
    data-placeholder="{{ $getPlaceholder() }}"
    @else
    multiple
    @endif
    {{ $attributes->except('options', 'multiple', 'label', 'placeholder') }}>

    @if (!$isMultiple())
    <option value="">{{ $getPlaceholder() }}</option>
    @endif

    @foreach ($options as $key => $text)
    <option value="{{ $key }}" @if($isSelected($key)) selected @endif>{{ $text }}</option>
    @endforeach
</select>