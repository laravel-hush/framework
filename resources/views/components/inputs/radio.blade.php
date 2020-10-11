@php
if (is_int($value)) {
    $value = $value > 0 ? $value : 1;
}
@endphp

<label
    {{ $attributes->filter(fn ($value, $key) => !in_array($key, ['readonly', 'disabled', 'checked']))->merge(['class' => 'radio']) }}>
    <input type="radio" name="{{ $name }}" class="form-control d-none" value="{{ $value }}"
        {{ $attributes->filter(fn ($value, $key) => in_array($key, ['readonly', 'disabled'])) }}
        {{ ($attributes['checked'] ?? false) ? 'checked' : '' }}>

    <div class="replacer">
        <i class="material-icons">done</i>
    </div>
    <span class="text">{{ $slot }}</span>
</label>
