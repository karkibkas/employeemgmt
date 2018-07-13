@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card-panel">
                <h4 class="center grey-text text-darken-1">Create a Category</h4>
                <div>
                    <form action="{{route('admin.categories.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12 m10 offset-m1 l10 offset-l1 xl10 offset-xl1">
                                <input type="text" name="title" id="title" value="{{old('title')}}">
                                <label for="title">Title</label>
                                @if($errors->has('title'))
                                    <span class="helper-text red-text">
                                        {{$errors->first('title')}}
                                    </span>
                                @endif
                            </div>
                            <div class="row"></div>
                            <button type="submit" class="btn bg waves-effect waves-light col s12 xl6 offset-xl3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection