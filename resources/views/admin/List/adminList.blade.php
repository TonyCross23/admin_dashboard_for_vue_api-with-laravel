@extends('admin.layouts.master')

@section('title','Admin List')

@section('content')

 <div class="container">
    <div class="offset-8 col-4">
        @if(Session::has('DeleteSuccess'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ Session::get('DeleteSuccess') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered Datatable">
                <thead>
                    <th class="text-cneter">ID</th>
                    <th class="text-cneter">Name</th>
                    <th class="text-cneter">Phone</th>
                    <th class="text-cneter">Email</th>
                    <th class="text-cneter">Address</th>
                    <th class="text-cneter">Gender</th>
                    <th class="text-center">Aciton</th>
                </thead>
                <tbody>

                    @foreach ($userData as $item)
                    <tr>
                        <td class="text-center">{{ $item->id }}</td>
                        <td class="text-center">{{ $item->name }}</td>
                        <td class="text-center">{{ $item->phone }}</td>
                        <td class="text-center">{{ $item->email }}</td>
                        <td class="text-center">{{ $item->address }}</td>
                        <td class="text-center">{{ $item->gender }}</td>
                        <td class="text-center">

                           <a href="{{ route('admin#accountDelete',$item->id) }}">
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                           </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
 </div>

@endsection

@section('scriptText')
<script>

        $(document).ready( function () {
            $('.Datatable').DataTable();
        } );

</script>

@endsection
