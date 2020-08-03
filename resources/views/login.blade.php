@extends ('hush::components.layouts.main')

@section ('body')
<div class="page-content animated login-page" id="content">
    <div class="row no-gutters align-items-center justify-content-center" style="height: 100vh">
        <div class="col col-sm-10 col-md-8 col-lg-5 col-xl-3 text-center">
            <div class="logo w-25 mx-auto mb-4">
                <img src="{{ asset('vendor/hush/images/long-logo.png') }}" alt="">
            </div>
            <div class="block">
                <div class="headline">
                    <span class="h1">@lang ('hush::admin.log-in')</span>
                </div>
                <div class="content">
                    <form action="{{ route('admin.login.post') }}" method="post" accept-charset="UTF-8">
                        @csrf
                        <div class="form-group">
                            <x-hush-input
                                type="email"
                                name="email"
                                :placeholder="__('hush::admin.email')"/>
                        </div>
                        <div class="form-group">
                            <x-hush-input
                                type="password"
                                name="password"
                                :placeholder="__('hush::admin.password')"/>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
