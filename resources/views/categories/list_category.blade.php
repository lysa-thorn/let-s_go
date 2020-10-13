@extends('template')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h3>Categories</h3>
            <a href="{{route('categories.create')}}" class="btn btn-secondary float-right">Create</a>
            <ul class="list-group mt-5">
                @foreach($categories as $category)
                <li class="list-group-item">{{$category->name}}
                    <a href="{{route('categories.destroy', $category->id)}}" onclick="return confirm('Are you sure want to delete?')"><i class="material-icons float-right text-danger" >delete</i></a>
                    <a href="{{route('categories.edit', $category->id)}}"><i class="material-icons float-right text-secondary" >edit</i></a>
                </li>

                @endforeach
            </ul>

        </div>
    </div>
</div>

@endsection

