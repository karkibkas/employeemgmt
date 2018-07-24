@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card-panel">
                <h4 class="center grey-text text-darken-2">Create New Customer</h4>
                <form action="{{route('admin.customers.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="name" id="name">
                            <label for="name">Name</label>
                            @if($errors->has('name'))
                                <span class="red-text helper-text">
                                    {{$errors->first('name')}}
                                </span>
                            @endif
                        </div>
                        <div class="input-field col s12">
                            <input type="email" name="email" id="email">
                            <label for="email">Email</label>
                            @if($errors->has('email'))
                                <span class="red-text helper-text">
                                    {{$errors->first('email')}}
                                </span>
                            @endif
                        </div>
                        <div class="input-field col s12">
                            <input type="password" name="password" id="password">
                            <label for="password">Password</label>
                            @if($errors->has('password'))
                                <span class="red-text helper-text">
                                    {{$errors->first('password')}}
                                </span>
                            @endif
                        </div>
                        <div class="row"></div>
                        <button type="submit" class="waves-effect waves-light btn col s8 offset-s2">Create Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection