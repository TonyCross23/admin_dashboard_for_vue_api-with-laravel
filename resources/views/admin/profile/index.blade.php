@extends('admin.layouts.master')

@section('title','Profile')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">

      @if(Session::has('Success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('Success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div
      @endif

      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action="{{ route('admin#profileChange',Auth::user()->id) }}" method="post">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="name" class="form-control" name="name" placeholder="Name" value="{{ old('name',Auth::user()->name) }}">

                    @if($errors->has('name'))
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif

                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email',Auth::user()->email) }}">

                    @if($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif

                </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" name="phone"  placeholder="Phone" value="{{ old('phone',Auth::user()->phone) }}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <textarea name="address" rows="3" class="form-control" placeholder="Address">{{ old('address',Auth::user()->address) }}</textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                      <select name="gender" class="form-control">
                        <option value="">Choice Gender</option>
                        <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                        <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                      </select>
                    </div>
                  </div>

                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <a href="{{ route('admin#changePasswordPage') }}">Change Password</a>
                        </div>
                      </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
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
