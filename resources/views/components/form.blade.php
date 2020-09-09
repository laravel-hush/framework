<form
    action="{{ $action }}"
    method="{{ $method }}"
    @if ($hasImages())
    enctype="{{ $imagesEnctype() }}"
    @elseif ($attributes['enctype'])
    enctype="{{ $attributes['enctype'] }}"
    @endif
    {{ $attributes->except('enctype') }}>

    @if ($method != 'get')
    @csrf
    @endif

    {{ $slot }}

</form>