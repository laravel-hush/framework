@if ($attributes['preview'] ?? false)
<div class="images-list text-center row px-2" id="{{ $getFileId() }}">
    @foreach ($value as $image)
    <div class="col-2 pb-3 image">
        <img src="{{ $image }}" alt="">
        <a href="{{ Constructor::link(['constructor' => [
            'id' => request()->id,
            'field' => $name,
            'image' => $image,
            'action' => 'remove-image'
        ]]) }}" class="btn btn-danger remove-image">
            <span class="col">@lang('hush::admin.delete')</span>
        </a>
    </div>
    @endforeach
</div>
@endif

<div class="custom-file">
    <input type="file" name="{{ $name }}[]" class="custom-file-input multiple" multiple
        data-image-block-id="#{{ $getFileId() }}">
    <label class="custom-file-label">
        @lang ('hush::admin.choose-files')
        <span>@lang ('hush::admin.browse')</span>
    </label>
</div>