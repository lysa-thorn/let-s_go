@extends('template')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header"><h4>Change Password</h4></div>
                <div class="card-body">
                    <form action="{{route('changePassword')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" name="new_password" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="Confirm_password" required class="form-control">
                        </div>
                        <button type="submit" class="btn btn-secondary">Change</button>
                        <a href="/home" class="btn btn-danger float-right">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

