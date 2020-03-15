<label class="checkbox">
    <input type="checkbox" name="{{ $name }}" class="form-control d-none"
        value="1" {{ $is_checked ? 'checked' : '' }}>

    <div class="replacer">
        <i class="material-icons">done</i>
    </div>

    @isset ($label)
    <span class="text">{{ $label ? __('hush::admin.' . $label) : '' }}</span>
    @endisset
</label>
