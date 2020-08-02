<label class="radio">
    <input type="radio" name="{{ $name }}" class="form-control d-none"
        value="{{ $value }}" {{ $is_checked ? 'checked' : '' }}>

    <div class="replacer">
        <i class="material-icons">done</i>
    </div>
    <span class="text">{{ $slot }}</span>
</label>