<div class="content">
    <form
        accept-charset="UTF-8"
        action="{{ Constructor::link($block['content']['link'] ?? '#') }}"
        class="submitable"
        enctype="multipart/form-data"
        id="{{ $block['content']['id'] ?? '' }}"
        method="post">

        @csrf

        @isset ($block['content']['grid'])
        <div class="row">
            @foreach ($block['content']['grid'] as $column)
            <div class="col {{ $column['size'] }}">
                @include ('hush::constructor.inputs', ['inputs' => $column['inputs']])
            </div>
            @endforeach
        </div>
        @else
            @include ('hush::constructor.inputs', ['inputs' => $block['content']['inputs']])
        @endisset

    </form>
</div>
