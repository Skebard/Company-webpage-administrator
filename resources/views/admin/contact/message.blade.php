
@extends('admin.admin_master')
@section('admin')
    <div class="py-12">


        <div class='container'>
            <div class="row">
                <h4>Admin Message</h4>
                <a href="{{route('add.contact')}}"><button class="btn btn-info">Add Contact</button></a>
                <br>
                <br>
                <div class="col-md-12">
                    <div class="card">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                        <div class="card-header">
                            All Message Data
                        </div>




                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="10%">Name</th>
                                    <th scope="col" width="15%"> Email</th>
                                    <th scope="col" width="15%">Subject </th>
                                    <th scope="col" width="15%">Message </th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($messages as $message)
                                <tr>
                                    <th scope="row">{{$i++  }}</th>
                                    <td>{{ $message->name }}</td>
                                    

                                    <!-- <td>{{-- $brand->name --}}</td> -->
                                    
                                    <td>
                                    
                                            {{ $message->email }}
                                    </td>
                                    <td>
                                    
                                    {{ $message->subject}}
                            </td>
                            <td>
                                {{ $message->message }}
                            </td>
                                      </td>
                                    <td>
                                    <a href="{{url('admin/message/delete/'.$message->id)}}" onclick='return confirm("Are you sure to delete?")' class='btn btn-danger'>Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
  

            </div>
        </div>







    </div>
@endsection