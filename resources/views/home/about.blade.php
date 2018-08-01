@extends('layouts.app')
@section('content')
<h3 class="center grey-text text-darken-1">About us</h3>
<div class="container-fluid">
    <br><br>
    <div class="row">
        <div class="col s12 m12 l6 xl6">
            <img src="{{asset('images/about/about1.jpeg')}}" alt="" width="100%">
        </div>
        <div class="col s12 m12 l6 xl6">
        <h4 class="grey-text text-darken-2 tex-uppercase">Our teamwork</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nulla explicabo quidem optio dolorum ea, quae, hic eos delectus eveniet, quis error recusandae rem facere. Quas a sapiente, minus ad culpa esse blanditiis quidem qui voluptates doloremque fugiat magni odit explicabo! Quia soluta quae aliquid voluptate error maxime consectetur harum, optio doloremque dolore dicta similique non saepe eos accusamus porro distinctio? Blanditiis unde eius esse cumque fugiat nisi, assumenda incidunt, quod praesentium nam obcaecati accusamus? Dolores nisi vel entore quia, dolorem impe</p>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m12 l6 xl6">
        <h4 class="grey-text text-darken-2 tex-uppercase">We are one</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nulla explicabo quidem optio dolorum ea, quae, hic eos delectus eveniet, quis error recusandae rem facere. Quas a sapiente, minus ad culpa esse blanditiis quidem qui voluptates doloremque fugiat magni odit explicabo! Quia soluta quae aliquid voluptate error maxime consectetur harum, optio doloremque dolore dicta similique non saepe eos accusamus porro distinctio? Blanditiis unde eius esse cumque fugiatentore quia, dolorem impe</p>
        </div>
        <div class="col s12 m12 l6 xl6">
            <img src="{{asset('images/about/about2.jpeg')}}" alt="" width="100%">
        </div>
    </div>
    <div class="row">
        <div class="col s12 m12 l6 xl6">
            <img src="{{asset('images/about/about3.jpeg')}}" alt="" width="100%">
        </div>
        <div class="col s12 m12 l6 xl6">
        <h4 class="grey-text text-darken-2 tex-uppercase">Our Respossible Team</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nulla explicabo quidem optio dolorum ea, quae, hic eos delectus eveniet, quis error recusandae rem facere. Quas a sapiente, minus ad culpa esse blanditiis quidem qui voluptates doloremque fugiat magni odit explicabo! Quia soluta quae aliquid voluptate error maxime consectetur harum, optio doloremque dolore dicta similique non saepe eos accusamus porro distinctio? Blanditiis unde eius esse cumque fugiat</p>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col s12">
            <div class="card-panel">
                <br>
                <h4 class="center grey-text text-darken-2">Send us a Message</h4>
                <br>
                <form action="{{route('contact')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="input-field login-field col s12 m6 l6 xl6">
                            <i class="material-icons prefix grey-text text-darken-2">person_outline</i>
                            <input type="text" name="first_name" id="first_name" value="{{old('first_name')}}">
                            <label for="first_name">First Name</label>
                            @if($errors->has('first_name'))
                                <span class="helper-text red-text">
                                    {{$errors->first('first_name')}}
                                </span>
                            @else
                                <span class="helper-text">Optional</span>
                            @endif
                        </div>
                        <div class="input-field login-field col s12 m6 l6 xl6">
                            <i class="material-icons prefix grey-text text-darken-2">person_outline</i>
                            <input type="text" name="last_name" id="last_name" value="{{old('last_name')}}">
                            <label for="last_name">Last Name</label>
                            @if($errors->has('last_name'))
                                <span class="helper-text red-text">
                                    {{$errors->first('last_name')}}
                                </span>
                            @else
                                <span class="helper-text">Optional</span>
                            @endif
                        </div>
                        <div class="input-field login-field col s12">
                            <i class="material-icons prefix grey-text text-darken-2">email</i>
                            <input type="email" name="email" id="email" value="{{old('email')}}">
                            <label for="email">Email</label>
                            @if($errors->has('email'))
                                <span class="helper-text red-text">
                                    {{$errors->first('email')}}
                                </span>
                            @endif
                        </div>
                        <div class="input-field login-field col s12">
                            <i class="material-icons prefix grey-text text-darken-2">message</i>
                            <textarea name="message" id="message" class="materialize-textarea">{{old('message')}}</textarea>
                            <label for="message">Message</label>
                            @if($errors->has('message'))
                                <span class="helper-text red-text">
                                    {{$errors->first('message')}}
                                </span>
                            @endif
                        </div>
                        <div class="row"></div>
                        <button type="submit" class="btn bg2 waves-effect waves-light col s10 offset-s1 m6 offset-m3">Send</button>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection