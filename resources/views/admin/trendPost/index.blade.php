@extends('admin.layouts.master')

@section('title','Trends Post Page')

@section('content')
      <div class="container-fluid">

        <div class="row">
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
                              <th>View Count</th>
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
                                    <td><i class="fa-solid fa-eye"></i>  {{ $item['post_count'] }}</td>
                                    <td>
                                   <a href="{{ route('admin#postDetails',$item['post_id']) }}"> <button class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-file-lines"></i></button></a>
                                    </td>
                                </tr>
                             @endforeach
                          </tbody>
                        </table>
                            {{-- <div class="d-flex justify-content-end me-5 mt-2">{{ $post->links() }}</div> --}}
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
      
        </div>

        </div>

      </div><!-- /.container-fluid -->
@endsection
