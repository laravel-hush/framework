<div class="modal" id="dynamic-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content swal2-show">
            <div class="modal-header">
                @isset ($settings['title'])
                <h5 class="modal-title">@lang ('hush::admin.' . $settings['title'])</h5>
                @endisset

                <button type="button" class="close" data-dismiss="modal" aria-label="@lang ('hush::admin.close')">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body row">
                @foreach ($settings['blocks'] as $block)
                <div class="col {{ $block['class'] ?? 'col-12' }}">
                    <div class="block">

                        @isset ($block['content'])
                        @include ('hush::constructor.' . $block['content']['type'])
                        @endisset

                    </div>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-dismiss="modal">
                    <i class="material-icons">close</i>
                    <span>@lang ('hush::admin.cancel')</span>
                </button>
                @include ('hush::constructor.buttons')
            </div>
        </div>
    </div>
</div>
