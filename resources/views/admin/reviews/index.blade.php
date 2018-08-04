@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <h4 class="center">Product Reviews</h4>
                    <br>
                    <table class="responsive-table centered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Product ID</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $review)
                                <tr>
                                    <td class="val">{{$loop->index + 1}}</td>
                                    <td class="val">{{$review->user_id}}</td>
                                    <td class="val">{{$review->product_id}}</td>
                                    <td class="val">{{$review->rating}}</td>
                                    <td>{{($review->status) ? 'Enabled' : 'Disabled' }}</td>
                                    <td>{{$review->created_at->diffForHumans()}}</td>
                                    <td>{{$review->updated_at->diffForHumans()}}</td>
                                    <td>
                                        <div class="center">
                                            <a href="{{route('admin.reviews.edit',$review->id)}}" class="btn-floating btn-small tooltipped waves-effect waves-light" data-position="left" data-tooltip="Review Details">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="#delete-modal-{{$review->id}}" class="modal-trigger btn-floating btn-small red tooltipped red waves-effect waves-light" data-position="left" data-tooltip="Delete Review">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            @component('components.confirm',[
                                                'id'    => 'delete-review-'.$review->id,
                                                'modal' => 'delete-modal-'.$review->id,
                                                'title' => 'Review'
                                            ])
                                            @endcomponent
                                            <form action="{{route('admin.reviews.destroy',$review->id)}}" method="post" class="hide" id="delete-review-{{$review->id}}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No Reviews yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <br>
                    <div class="center-align">
                        {{$reviews->links('vendor.pagination.default',[
                            'items' => $reviews
                        ])}}
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection