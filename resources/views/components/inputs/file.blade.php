@if ($attributes['preview'] ?? false)
<div class="text-center">
    <img src="{{ $value }}" alt="" class="custom-file-image" id="{{ $getFileId() }}">
</div>
@endif

<div class="custom-file">
    <input
        type="file"
        name="{{ $name }}"
        class="custom-file-input"
        data-image-id="#{{ $getFileId() }}"
        {{ $attributes->except('multiple', 'preview', 'id') }}/>

    <label class="custom-file-label">
        <span class="file">@lang('hush::admin.choose-file')</span>
        <span class="browse">@lang('hush::admin.browse')</span>
    </label>
</div>
