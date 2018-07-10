@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card-panel col s12 m8 offset-m2 l6 offset-l3 xl6 offset-xl3">
            <h4 class="center">Enter Your Email</h4>
            <form method="post" action="{{route('password.email')}}">
                @csrf
                <div class="input-field">
                    <input type="text" name="email" id="email">
                    <label for="email">Email</label>
                    @if($errors->has('email'))
                        <span class="helper-text red-text">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <button type="submit" class="btn waves-effect waves-light">Send Link</button>
            </form>
        </div>
    </div>
</div>
@endsection