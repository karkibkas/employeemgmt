@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card-panel">
                <h4 class="center grey-text text-darken-2">Manage Addresses</h4>
                <br>
                <table class="table-responsive centered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Address line 1</th>
                            <th>City</th>
                            <th>Postal Code</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($addresses as $address)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$address->id}}</td>
                                <td>{{str_limit($address->address_1,15)}}</td>
                                <td>{{$address->city}}</td>
                                <td>{{$address->postal_code}}</td>
                                <td>{{$address->created_at->diffForHumans()}}</td>
                                <td>{{$address->updated_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('admin.addresses.show',$address->id)}}" class="btn-floating btn-small tooltipped" data-position="left" data-tooltip="Address Details!">
                                        <i class="material-icons">visibility</i>
                                    </a>
                                    <a href="#delete-modal-{{$address->id}}" class="btn-floating btn-small red modal-trigger tooltipped" data-position="right" data-tooltip="Delete Address!">
                                        <i class="material-icons">delete</i>
                                    </a>
                                    @component('components.confirm',[
                                        'id'    => 'delete-address-'.$address->id,
                                        'modal' => 'delete-modal-'.$address->id,
                                        'title' => 'Address'
                                    ])
                                    @endcomponent
                                    <form action="{{route('admin.addresses.destroy',$address->id)}}" method="post" class="hide" id="delete-address-{{$address->id}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <h4 class="center grey-text text-darken-2">No Addresses to Display!</h4>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <br>
                <div class="center-align">
                    {{$addresses->links('vendor.pagination.default',[ 'items' => $addresses])}}
                </div>
                <br><br>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn">
        <a href="{{route('admin.addresses.create')}}" class="red waves-effect waves-light btn-floating btn-large">
            <i class="material-icons">add</i>
        </a>
    </div>
</div>
@endsection