@extends('layouts.app')

@section('title') {{trans('auth.password_recover')}} -@endsection

@section('content')
  <div class="jumbotron home m-0 bg-gradient">
    <div class="container pt-lg-md">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card bg-light shadow border-0">
            <div class="card-header bg-white py-4">
              <h4 class="text-center mb-0 font-weight-bold">
                {{trans('auth.password_recover')}}
              </h4>
              <small class="btn-block text-center mt-2">{{ trans('auth.recover_pass_subtitle') }}</small>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              @if (session('status'))
                      <div class="alert alert-success">
                        {{{ session('status') }}}
                      </div>
                    @endif

              @include('errors.errors-forms')

              <form method="POST" action="{{ route('password.email') }}">
                  @csrf

                  @if($settings->captcha == 'on')
                    @captcha
                  @endif

                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input class="form-control" value="{{ old('email')}}" placeholder="{{trans('auth.email')}}" name="email" required type="text">

                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4 w-100">{{trans('auth.send_pass_reset')}}</button>
                </div>
              </form>

              @if ($settings->captcha == 'on')
                <small class="btn-block text-center">{{trans('auth.protected_recaptcha')}} <a href="https://policies.google.com/privacy" target="_blank">{{trans('general.privacy')}}</a> - <a href="https://policies.google.com/terms" target="_blank">{{trans('general.terms')}}</a></small>
              @endif

            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="{{url('login')}}" class="text-light">
                <small><i class="fas fa-arrow-left"></i> {{trans('auth.back_login')}}</small>
              </a>
            </div>
            <div class="col-6 text-right">
              <a href="{{url('signup')}}" class="text-light">
                <small>{{trans('auth.not_have_account')}}</small>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
<script type="text/javascript">
	@if (count($errors) > 0)
    	scrollElement('#dangerAlert');
    @endif
</script>
@endsection
