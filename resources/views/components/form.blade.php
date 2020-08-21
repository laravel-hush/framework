<form
    action="{{ $action }}"
    method="{{ $method }}"
    @if ($hasImages())
    enctype="{{ $imageEnctype }}"
    @elseif ($attributes['enctype'])
    enctype="{{ $attributes['enctype'] }}"
    @endif
    {{ $attributes->except('enctype') }}>

    @csrf
    {{ $slot }}

</form>