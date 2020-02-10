@extends('layouts.master')
@section('content')
<style type="text/css">
    .logo-img{
        display: flex;
        margin-bottom: 20px;
        justify-content: center;
    }
</style>
<div class="login-box">
    <div class="login-logo">
        Project Manage
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <!-- <p class="login-box-msg">{{ __('Login') }}</p> -->
            <div class="col-md-12 logo-img">
                <img src="{{asset('img/logo.jpg')}}" width="80%" class="text-center" />
            </div>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                        <span class="fa fa-envelope input-group-text"></span> @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span> @endif
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                        required>
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span> @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span> @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

           

          
            <!-- <p class="mb-0">
                <a href="{{route('register')}}" class="text-center">Register a new membership</a>
            </p> -->
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
@endsection