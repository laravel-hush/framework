@isset ($settings['scripts'])
    @foreach ($settings['scripts'] as $script)
        <script>{!! file_get_contents($script) !!}</script>
    @endforeach
@endisset
