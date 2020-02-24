<div class="modal" id="dynamic-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content swal2-show">
            <div class="modal-header">
                <h5 class="modal-title">@lang ('hush::admin.search')</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                <form id="search-form">
                    <div class="form-group">
                        {!! Form::text('search', null, [
                            'class' => 'form-control',
                            'placeholder' => __('hush::admin.search-query')
                        ]) !!}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-dismiss="modal">
                    <i class="material-icons">close</i>
                    <span>@lang ('hush::admin.cancel')</span>
                </button>
                <button class="btn btn-primary" form="search-form">
                    <i class="material-icons">save</i>
                    <span>@lang ('hush::admin.submit')</span>
                </button>
            </div>
        </div>
    </div>
</div>
