@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card-panel">
                @component('components.order-details',[
                    'order' => $order,
                    'products' => $products
                ])
                @endcomponent
                <br>
                <div class="row">
                    <a href="{{route('admin.orders.edit',$order->id)}}" class="btn center col s8 offset-s2 waves-effect waves-light">Update</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection