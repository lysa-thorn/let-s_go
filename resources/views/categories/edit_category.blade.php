@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 mt-5">
            <div class="card">
                <div class="card-header"><h4>Edit Category</h4></div>
                <div class="card-body">
                    <form action="{{route('categories.update', $category->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Category</label>
                            <input type="text" value="{{$category->name}}" name="category" class="form-control">
                            <button type="submit" class="btn btn-secondary mt-2">Edit</button>
                            <a href="{{route('categories.index')}}" class="float-right btn btn-danger mt-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
