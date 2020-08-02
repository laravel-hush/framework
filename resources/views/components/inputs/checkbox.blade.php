<label class="checkbox" {{ $attributes ?? '' }}>
    <input type="checkbox" name="{{ $name }}" class="form-control d-none"
        value="{{ $value }}" {{ $is_checked ? 'checked' : '' }}>

    <div class="replacer">
        <i class="material-icons">done</i>
    </div>

    @isset ($slot)
    <span class="text">{{ $slot }}</span>
    @endisset
</label>
