@php
$values = Constructor::value(get_defined_vars(), $input, $input['default'] ?? null);
@endphp

<div class="col {{ $input['width'] ?? 'col-12' }}">

    @isset($input['label'])
        <label class="ml-1">@lang('hush::admin.' . $input['label'])</label>
    @endisset

    <div id="{{ $input['name'] }}">
        @foreach ($values as $i => $item)
            @include('hush::components.iterable-item')
        @endforeach
    </div>

    <div class="mt-2 ml-1">
        <button class="btn btn-light" id="add-{{ $input['name'] }}">
            @lang('hush::admin.add')
        </button>
    </div>

</div>

@push('js')
<script>
    var i = {{ $values->count() }};

    function {{ $input['name'] }}Deleter() {
        $('.delete-{{ $input['name'] }}').off('click').click(function (event) {
            event.preventDefault();
            Swal.fire({
                title: __.are_you_sure,
                text: __.you_wont_be_able_to_revert,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: __.yes_delete_it,
                cancelButtonText: __.cancel,
            }).then((result) => {
                if (result.value) {
                    $(this).closest('.iterable-item').remove();
                }
            })
        });
    }

    $('#add-{{ $input['name'] }}').click(function (event) {
        event.preventDefault();
        $('#{{ $input['name'] }}').append(`@include('hush::components.iterable-item', [
            'i' => null,
            'item' => null
        ])`);
        i++;

        {{ $input['name'] }}Deleter();
    });

    {{ $input['name'] }}Deleter();
</script>
@endpush
