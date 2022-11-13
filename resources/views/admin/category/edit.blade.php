@extends('admin.layouts.master')

@section('title','Categroy Page')

@section('content')
      <div class="container-fluid">

        <div class="row">
            <div class="col-4">
                <form action="{{ route('admin#updateCategory',$updateCategory['category_id']) }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Category Name</label>
                      <input type="text" class="form-control" name="categoryName" value="{{ old('categroyName',$updateCategory['title']) }}" placeholder="Enter Categroy Name">

                      @if($errors->has('categoryName'))
                            <p class="text-danger">{{ $errors->first('categoryName') }}</p>
                      @endif

                    </div>
                    <div class="form-group">
                      <label>Description</label>
                     <textarea name="categoryDescription" class="form-control" rows="6" placeholder="Enter Description">{{ old('categoryDescription',$updateCategory['description']) }}</textarea>

                     @if($errors->has('categoryDescription'))
                     <p class="text-danger">{{ $errors->first('categoryDescription') }}</p>
                 @endif

                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin#category') }}"><button type="button" class="btn btn-dark">Create</button></a>
                  </form>
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
                              <th>Category Name</th>
                              <th>Description</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                             @foreach ($category as $item)
                                <tr>
                                    <td>{{ $item->category_id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                    <a href="{{ route('admin#editPage',$item->category_id) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                                    <a href="{{ route('admin#categoryDelete', $item->category_id) }}">
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
