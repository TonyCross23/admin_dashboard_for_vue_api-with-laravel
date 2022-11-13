@extends('admin.layouts.master')

@section('title','Password Change')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">

      @if(Session::has('notMath'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('notMath') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      @endif

      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Password Change</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action="{{ route('admin#changePassword',Auth::user()->id) }}" method="post">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-4 col-form-label">Old Password</label>
                  <div class="col-6">
                    <input type="password" class="form-control" name="oldPassword" placeholder="Old Password">

                    @if($errors->has('oldPassword'))
                        <p class="text-danger">{{ $errors->first('oldPassword') }}</p>
                    @endif

                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-4 col-form-label">New Password</label>
                  <div class="col-6">
                    <input type="password" class="form-control" name="newPassword" placeholder="New Password">

                    @if($errors->has('newPassword'))
                        <p class="text-danger">{{ $errors->first('newPassword') }}</p>
                    @endif

                  </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail" class="col-4 col-form-label">Confirm Password</label>
                    <div class="col-6">
                      <input type="password" class="form-control" name="confirmPassword"  placeholder="Confirm Password">

                      @if($errors->has('confirmPassword'))
                          <p class="text-danger">{{ $errors->first('confirmPassword') }}</p>
                      @endif

                    </div>
                  </div>

                <div class="form-group row">
                  <div class="offset-3 col-6 mt-3">
                    <button type="submit" class="btn bg-dark text-white">Change Password</button>
                  </div>
                </div>
              </form>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
