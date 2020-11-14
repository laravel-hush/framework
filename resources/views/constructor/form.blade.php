<div class="content">
    <x-hush-form
        accept-charset="UTF-8"
        :action="Constructor::link($block['content']['link'] ?? '#')"
        :class="isset($block['content']['synchronous']) ? '' : 'submitable'"
        has-images="true"
        :id="$block['content']['id'] ?? ''"
        :method="$block['content']['method'] ?? 'post'">

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

    </x-hush-form>
</div>
