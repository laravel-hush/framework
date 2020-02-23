@extends ('hush::components.layouts.main')

@section ('body')
<div class="page-content animated" id="content">
    <div class="row no-gutters align-items-center justify-content-center" style="height: 100vh">
        <div class="col col-3">
            <div class="block">
                <div class="headline">
                    <span class="h1">@lang ('hush::admin.login')</span>
                </div>
                {!! Form::open(['url' => route('admin.login.post')]) !!}
                    <div class="form-group">
                        {!! Form::email('email', '', [
                            'class' => 'form-control',
                            'placeholder' => __('hush::admin.email')
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::input('password', 'password', '', [
                            'class' => 'form-control',
                            'placeholder' => __('hush::admin.password')
                        ]) !!}
                    </div>
                    <div class="form-group text-center {{ (isset($errors) && $errors->has('email')) ? 'error' : '' }}">
                        @if (isset($errors) && $errors->has('email'))
                        <small>{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="/" class="btn btn-light mr-2">
                            @lang ('hush::admin.cancel')
                        </a>
                        <button class="btn btn-primary">
                            @lang ('hush::admin.login')
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
