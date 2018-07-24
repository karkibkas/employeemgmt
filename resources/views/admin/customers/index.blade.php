@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card-panel">
                <h4 class="center grey-text text-darken-2">Manage Customers</h4>
                <br>
                <table class="responsive-table centered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{$loop->index + 1 }}</td>
                            <td>{{$customer->id}}</td>
                            <td>
                                <img src="{{$customer->gravatar}}" alt="{{$customer->name}}" width="50" height="50" class="circle">
                            </td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->created_at->diffForHumans()}}</td>
                            <td>{{$customer->updated_at->diffForHumans()}}</td>
                            <td>
                                <div class="center">
                                    <a href="{{route('admin.customers.edit',$customer->id)}}" class="btn-floating btn-small tooltipped" data-position="left" data-tooltip="Update Customer!">
                                        <i class="material-icons">mode_edit</i>
                                    </a>
                                </div>
                            </td>
                        </tr>    
                    @endforeach
                    </tbody>
                </table>
                <br>
                <div class="center-align">
                    {{$customers->links('vendor.pagination.default',[ 'customers' => $customers ])}}
                </div>
                <br><br>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn">
        <a href="{{route('admin.customers.create')}}" class="btn-floating btn-large red waves-effect waves-light">
            <i class="material-icons">add</i>
        </a>
    </div>
</div>
@endsection