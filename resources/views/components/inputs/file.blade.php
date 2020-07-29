@if (!isset($multiple))

<div class="text-center">
    <img src="{{ $value ?? '' }}" alt="" class="custom-file-image" id="{{ $id ?? $name ?? 'image' }}">
</div>
<div class="custom-file">
    <input type="file" name="{{ $name }}" class="custom-file-input" data-image-id="#{{ $id ?? $name ?? 'image' }}">
    <label class="custom-file-label">
        @lang ('hush::admin.choose-file')
        <span>@lang ('hush::admin.browse')</span>
    </label>
</div>

@else

<div class="images-list text-center row px-2" id="{{ $id ?? 'multiple-image' }}">
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
<div class="custom-file">
    <input type="file" name="{{ $name }}[]" class="custom-file-input multiple" multiple
        data-image-block-id="#{{ $id ?? 'multiple-image' }}">
    <label class="custom-file-label">
        @lang ('hush::admin.choose-files')
        <span>@lang ('hush::admin.browse')</span>
    </label>
</div>

@endif