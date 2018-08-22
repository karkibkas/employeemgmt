@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col s12">
            <div class="card-panel">
                <h4 class="center">Contact Messages</h4>
                <table class="responsive-table centered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                        <tr>
                            <td>{{$contact->id}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{str_limit($contact->message,20)}}</td>
                            <td>{{$contact->created_at->diffForHumans()}}</td>
                            <td>{{$contact->updated_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('admin.contacts.show',$contact->id)}}" class="btn-floating btn-small waves-effect waves-light tooltipped" data-position="left" data-tooltip="Message Details">
                                    <i class="material-icons">visibility</i>
                                </a>
                                <a href="#delete-modal-{{$contact->id}}" class="btn-floating btn-small red waves-effect waves-light modal-trigger tooltipped" data-position="left" data-tooltip="Delete Message!">
                                    <i class="material-icons">delete</i>
                                </a>
                                @component('components.confirm',[
                                    'id' => 'delete-contact-'.$contact->id,
                                    'modal' => 'delete-modal-'.$contact->id,
                                    'title' => 'Message'
                                ])
                                @endcomponent
                                <form action="{{route('admin.contacts.destroy',$contact->id)}}" method="post" class="hide" id="delete-contact-{{$contact->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5 class="center">No Messages Found Yet!</h5>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <br>
                <div class="center-align">
                    {{$contacts->appends(request()->query())->links('vendor.pagination.default',[
                        'items' => $contacts
                    ])}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection