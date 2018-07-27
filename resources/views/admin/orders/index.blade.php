@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card-panel">
                <h4 class="center grey-text text-darken-2">Manage Orders</h4>
                <br>
                <table class="responsive-table centered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Address ID</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->address_id}}</td>
                                <td>{{($order->paid) ? 'Paid' : 'Failed'}}</td>
                                <td class="val grey-text text-darken-2">${{number_format($order->total,2)}}</td>
                                <td>{{$order->created_at->diffForHumans()}}</td>
                                <td>{{$order->updated_at->diffForHumans()}}</td>
                                <td>
                                    <div class="center">
                                        <a href="{{route('admin.orders.show',$order->id)}}" class="btn-floating btn-small tooltipped waves-effect waves-light" data-position="left" data-tooltip="Order Details">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="#delete-modal-{{$order->id}}" class="modal-trigger btn-floating btn-small red tooltipped red waves-effect waves-light" data-position="left" data-tooltip="Delete Order">
                                            <i class="material-icons">delete</i>
                                        </a>
                                        @component('components.confirm',[
                                            'id'    => 'delete-order-'.$order->id,
                                            'modal' => 'delete-modal-'.$order->id,
                                            'title' => 'Order'
                                        ])
                                        @endcomponent
                                        <form action="{{route('admin.orders.destroy',$order->id)}}" method="post" class="hide" id="delete-order-{{$order->id}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <h4 class="center grey-text text-darken-2">No Orders to Display!</h4>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <br>
                <div class="center-align">
                    {{$orders->links('vendor.pagination.default',[ 'items' => $orders ])}}
                </div>
                <br><br>
            </div>
        </div>
    </div>
</div>
@endsection