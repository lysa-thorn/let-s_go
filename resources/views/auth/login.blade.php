@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><h3>Let's Go</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                       <div class="form-group">
                           <h5><label for="">Email</label></h5>
                           <input id="email" type="email" class="form-control" name="email"  required  autofocus>
                       </div>

                      <div class="form-group">
                          <h5><label for="">Password</label></h5>
                          <input id="password" type="password" class="form-control" name="password">
                      </div>
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
