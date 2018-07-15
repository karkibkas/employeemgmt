@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col s12 m12 l8 xl8">
            <div class="card-panel">
                <div class="row">
                    <form action="{{route('checkout')}}" method="post" id="checkout-form">
                        @csrf
                        <div class="col s12 m12 l12 xl12">
                            <br>
                            <h5 class="center grey-text text-darken-1" >Shipping Address</h5>
                            <br>
                            <div class="input-field">
                                <textarea name="address_1" id="address_1" class="materialize-textarea"></textarea>
                                <label for="address_1">Address line 1</label>
                                @if($errors->has('address_1'))
                                    <span class="helper-text red-text">
                                        {{$errors->first('address_1')}}
                                    </span>
                                @endif
                            </div>
                            <div class="input-field">
                                <textarea name="address_2" id="address_2" class="materialize-textarea"></textarea>
                                <label for="address_2">Address Line 2</label>
                                @if($errors->has('address_2'))
                                    <span class="helper-text red-text">
                                        {{$errors->first('address_2')}}
                                    </span>
                                @endif
                            </div>
                            <div class="input-field">
                                <input type="text" name="city" id="city">
                                <label for="city">City</label>
                                @if($errors->has('city'))
                                    <span class="helper-text red-text">
                                        {{$errors->first('city')}}
                                    </span>
                                @endif
                            </div>
                            <div class="input-field">
                                <input type="text" name="postal_code" id="postal_code">
                                <label for="postal_code">Postal code</label>
                                @if($errors->has('postal_code'))
                                    <span class="helper-text red-text">
                                        {{$errors->first('postal_code')}}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col s12 m12 l4 xl4">
            <div class="card-panel">
                @component('components.cart-summary')
                @endcomponent
                <br>
                <a href="#" class="btn waves-effect waves-light" onclick="this.preventDefault;document.querySelector('#checkout-form').submit()">Place Order</a>
            </div>
        </div>
    </div>
</div>
@endsection