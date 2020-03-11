<div class="text-center my-2">
    <img src="{{ $value ?? '' }}" alt="" class="custom-file-image" id="{{ $id ?? 'image' }}">
</div>
<div class="custom-file">
    <input type="file" name="{{ $name }}" class="custom-file-input" data-image-id="#{{ $id ?? 'image' }}">
    <label class="custom-file-label">
        @lang ('hush::admin.choose-file')
        <span>@lang ('hush::admin.browse')</span>
    </label>
</div>
