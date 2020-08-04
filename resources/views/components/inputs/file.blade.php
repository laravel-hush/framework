@if ($attributes['preview'] ?? false)
<div class="text-center">
    <img src="{{ $value }}" alt="" class="custom-file-image" id="{{ $getFileId() }}">
</div>
@endif

<div class="custom-file">
    <input type="file" name="{{ $name }}" class="custom-file-input" data-image-id="#{{ $getFileId() }}">
    <label class="custom-file-label">
        @lang('hush::admin.choose-file')
        <span>@lang('hush::admin.browse')</span>
    </label>
</div>