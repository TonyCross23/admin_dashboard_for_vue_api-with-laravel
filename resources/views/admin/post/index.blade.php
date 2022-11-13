@extends('admin.layouts.master')

@section('title','Post Page')

@section('content')
      <div class="container-fluid">

        <div class="row">
            <div class="col-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="{{ route('admin#createPage') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label>Post Title</label>
                              <input type="text" class="form-control" name="postTitle" value="{{ old('postTitle') }}" placeholder="Enter Post Title">
                              @if($errors->has('postTitle'))
                                    <p class="text-danger">{{ $errors->first('postTitle') }}</p>
                              @endif
                            </div>

                            <div class="form-group">
                              <label>Description</label>
                             <textarea name="postDescription" class="form-control" rows="6" value="{{ old('postDescription') }}" placeholder="Enter Post Description"></textarea>
                             @if($errors->has('postDescription'))
                                <p class="text-danger">{{ $errors->first('postDescription') }}</p>
                            @endif
                            </div>

                            <div class="form-group">
                                <label>Post Image</label>
                                <input type="file" name="postImage" class="form-control">
                                @if($errors->has('postImage'))
                                      <p class="text-danger">{{ $errors->first('postImage') }}</p>
                                @endif
                              </div>

                              <div class="form-group">
                                <label>Post Category</label>
                                    <select name="postCategory" class="form-control">
                                        <option value="">Chose Option</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item['category_id'] }}">{{ $item['title'] }}</option>
                                        @endforeach
                                    </select>
                                @if($errors->has('postCategory'))
                                      <p class="text-danger">{{ $errors->first('postCategory') }}</p>
                                @endif
                              </div>

                            <button type="submit" class="btn btn-dark">Create</button>
                          </form>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="">
                    @if(Session::has('DeleteSuccess'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('DeleteSuccess') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>

                    <div class="card mt-4">
                      <div class="card-header">
                        <div class="card-tools">
                          <form action="{{ route('admin#categorySearch') }}" method="post">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="categorySearch" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                  </button>
                                </div>
                              </div>
                          </form>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap text-center">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Post Title</th>
                              <th>Image</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                             @foreach ($post as $item)
                                <tr>
                                    <td>{{ $item['post_id']}}</td>
                                    <td>{{ $item['title'] }}</td>
                                    <td><img width="90px" class="rounded shadow" @if ( $item['image'] == null)
                                        src="{{ asset('defaultImage/default-profile.png') }}"
                                    @endif
                                    src="{{ asset('postImage/'.$item['image']) }}"></td>
                                    <td>
                                   <a href="{{ route('admin#editPost',$item['post_id']) }}"> <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                                    <a href="{{ route('admin#postDelete',$item['post_id']) }}">
                                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                                    </a>
                                    </td>
                                </tr>
                             @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
            </div>
        </div>

        </div>

      </div><!-- /.container-fluid -->
@endsection
