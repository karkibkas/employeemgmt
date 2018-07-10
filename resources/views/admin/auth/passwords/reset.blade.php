@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card-panel col s12 m8 offset-m2 l6 offset-l3 xl6 offset-xl3">
            <h4 class="center">Reset Password</h4>
            <form method="POST" action="{{ route('admin.password.request') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="input-field">
                    <input type="email" name="email" id="email" value="{{old('email')}}">
                    <label for="email">Email</label>
                    @if($errors->has('email'))
                        <span class="helper-text red-text">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" value="{{old('password')}}">
                    <label for="password">Password</label>
                    @if($errors->has('password'))
                        <span class="helper-text red-text">{{$errors->first('password')}}</span>
                    @endif
                </div>
                <div class="input-field">
                    <input type="password" name="password_confirmation" id="password-confirm" value="{{old('password-confirm')}}">
                    <label for="password-confirm">Confirm Password</label>
                    @if($errors->has('password-confirm'))
                        <span class="helper-text red-text">{{$errors->first('password-confirm')}}</span>
                    @endif
                </div>
                <button type="submit" class="btn col s12 m8 offset-m2 l6 offset-l3 xl6 offset-xl3">Reset Password</button>
                <br><br><br>
            </form>
        </div>
    </div>
</div>
@endsection
