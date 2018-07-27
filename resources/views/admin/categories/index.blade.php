@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card-panel">
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$category->id}}</td>
                                <td>{{$category->title}}</td>
                                <td>{{$category->created_at->diffForHumans()}}</td>
                                @if($category->updated_at)
                                    <td>{{$category->updated_at->diffForHumans()}}</td>
                                @else
                                    <td>Not updated</td>
                                @endif
                                <td>
                                    <a href="{{route('admin.categories.edit',$category->id)}}" class="btn-floating btn-small waves-effect orange waves-light">
                                        <i class="material-icons">mode_edit</i>
                                    </a>
                                    <a href="#delete-modal-{{$category->id}}" class="btn-floating btn-small waves-effect red modal-trigger waves-light">
                                        <i class="material-icons">delete</i>
                                    </a>
                                </td>
                                @component('components.confirm',[
                                    'id' => 'delete-form-'.$category->id,
                                    'modal' => 'delete-modal-'.$category->id,
                                    'title' => 'Category'
                                ])
                                @endcomponent
                                <form action="{{route('admin.categories.destroy',$category->id)}}" method="post" class="hide" id="delete-form-{{$category->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <h4 class="center grey-text text-darken-2">No Categories to Display!</h4>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="fixed-action-btn">
                <a href="{{route('admin.categories.create')}}" class="btn-floating btn-large waves-effect waves-light red">
                    <i class="large material-icons">add</i>
                </a>
            </div>
        </div>
    </div>
@endsection