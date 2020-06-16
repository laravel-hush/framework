<label class="checkbox">
    <input type="checkbox" name="{{ $name }}" class="form-control d-none"
        value="{{ $value ?? 1 }}" {{ isset($is_checked) && $is_checked ? 'checked' : '' }}>

    <div class="replacer">
        <i class="material-icons">done</i>
    </div>

    @isset ($label)
    <span class="text">{{ $label ?? '' }}</span>
    @endisset
</label>
