@if ($attributes['preview'] ?? false)
<div class="images-list text-center row px-2">
    @foreach ($value as $image)
    <div class="{{ $attributes['preview-width'] ?? 'col-2' }} pb-3 image saved">
        <img src="{{ $image }}" alt="">
        @if (!isset($attributes['delete']) || $attributes['delete'])
        <a href="{{ Constructor::link("action:remove-image|field:$name|image:$image|id:" . request()->id) }}"
            class="btn btn-danger remove-image">
            <span class="col">@lang('hush::admin.delete')</span>
        </a>
        @endif
    </div>
    @endforeach
</div>
<div class="images-list text-center row px-2" id="{{ $getFileId() }}"></div>
@endif

<div class="custom-file">
    <input type="file" name="{{ $name }}[]" class="custom-file-input multiple" multiple
        data-image-block-id="#{{ $getFileId() }}" {{ $attributes->except('multiple', 'preview', 'id') }}>
    <label class="custom-file-label">
        @lang ('hush::admin.choose-files')
        <span>@lang ('hush::admin.browse')</span>
    </label>
</div>
