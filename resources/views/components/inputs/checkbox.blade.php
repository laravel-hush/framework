<label
    {{ $attributes->filter(fn ($value, $key) => !in_array($key, ['readonly', 'disabled']))->merge(['class' => 'checkbox']) }}>
    <input type="checkbox" name="{{ $name }}" class="form-control d-none" value="{{ $value }}"
        {{ $is_checked ? 'checked' : '' }}
        {{ $attributes->filter(fn ($value, $key) => in_array($key, ['readonly', 'disabled'])) }}>

    <div class="replacer">
        <i class="material-icons">done</i>
    </div>

    @isset ($slot)
    <span class="text">{{ $slot }}</span>
    @endisset
</label>