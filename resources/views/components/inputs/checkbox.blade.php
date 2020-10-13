@php
if (is_int($value) || empty($value)) {
    $value = $value > 0 ? $value : 1;
}
@endphp

<label
    {{ $attributes->filter(fn ($value, $key) => !in_array($key, ['readonly', 'disabled', 'checked']))->merge(['class' => 'checkbox']) }}>
    <input type="checkbox" name="{{ $name }}" class="form-control d-none" value="{{ $value }}"
        {{ $attributes->filter(fn ($value, $key) => in_array($key, ['readonly', 'disabled'])) }}
        {{ ($attributes['checked'] ?? false) ? 'checked' : '' }}>

    <div class="replacer">
        <i class="material-icons">done</i>
    </div>

    @isset ($slot)
    <span class="text">{{ $slot }}</span>
    @endisset
</label>
