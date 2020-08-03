<label
    {{ $attributes->filter(fn ($value, $key) => !in_array($key, ['readonly', 'disabled']))->merge(['class' => 'radio']) }}>
    <input type="radio" name="{{ $name }}" class="form-control d-none" value="{{ $value }}"
        {{ $is_checked ? 'checked' : '' }}
        {{ $attributes->filter(fn ($value, $key) => in_array($key, ['readonly', 'disabled'])) }}>

    <div class="replacer">
        <i class="material-icons">done</i>
    </div>
    <span class="text">{{ $slot }}</span>
</label>