@extends('admin.layouts.master')

@section('title','Trends Post Detail Page')

@section('content')

      <div class="container-fluid col-8 offset-2">
        <div class="card mt-4">
            <a href="{{ route('admin#trendPost') }}" class="ms-2 mt-2 text-dark"><i class="fa-solid fa-arrow-left"></i></a>
            <div class="card-header">
                <h3 class="text-center">{{ $post['title'] }}</h3>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img width="400px" class="rounded shadow" @if ( $post['image'] == null)
                                src="{{ asset('defaultImage/default-profile.png') }}"
                            @endif
                                src="{{ asset('postImage/'.$post['image']) }}">
                </div>
                <p class="text-start mt-3">{{ $post['description'] }}</p>
            </div>
        </div>
      </div><!-- /.container-fluid -->
@endsection
