@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card-panel col s12 m8 offset-m2 l6 offset-l3 xl6 offset-xl3">
            <h4 class="center grey-text text-darken-1">Admin Login</h4>
            <form action="{{route('admin.login')}}" method="post">
                @csrf()
                <div class="input-field">
                    <input type="email" name="email" id="email">
                    <label for="email">Email</label>
                    @if($errors->has('email'))
                        <span class="helper-text red-text">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password">
                    <label for="password">Password</label>
                    @if($errors->has('password'))
                        <span class="helper-text red-text">{{$errors->first('password')}}</span>
                    @endif
                </div>
                <p>
                    <label for="remember">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Remember Me</span>
                    </label>
                </p>
                <div class="row"></div>
                <button type="submit" class="btn mb-5 left">Login</button>
                <a href="{{route('admin.password.request')}}" class="btn right">Forgot Password</a>
                <br><br><br>
            </form>
        </div>
    </div>
</div>
@endsection
