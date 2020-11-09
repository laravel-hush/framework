<div class="row">
    @foreach ($langs as $i => $lang)
        <div class="form-group {{ $getFieldWidth() }}">

            @isset($attributes['label'])
                <label for="{{ $name . "[$lang->code]" }}">
                    @lang('hush::admin.' . $attributes['label']) ({{ $lang->name }})
                </label>
            @endisset

            @if ($attributes['preview'] ?? false)
                <div class="text-center">
                    <img @isset($value) src="{{ $value[$lang->code] ?? '' }}" @endisset
                        alt="" class="custom-file-image" id="{{ $getFileId() }}-{{ $lang->code }}">
                </div>
            @endif

            <div class="custom-file">
                <input
                    type="file"
                    name="{{ $name . '[' . $lang->code . ']' }}"
                    class="custom-file-input"
                    data-image-id="#{{ $getFileId() }}-{{ $lang->code }}"
                    {{ $attributes->except('multilingual', 'multiple', 'preview', 'id') }}/>

                <label class="custom-file-label">
                    @lang('hush::admin.choose-file')
                    <span>@lang('hush::admin.browse')</span>
                </label>
            </div>
        </div>
    @endforeach
</div>
