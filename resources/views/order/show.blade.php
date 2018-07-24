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
            </div>
        </div>
    </div>
</div>

@endsection