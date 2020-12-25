
@extends('admin.admin_master')
@section('admin')
    <div class="py-12">


        <div class='container'>
            <div class="row">
                <h4>Contact Page</h4>
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
                            All Contact Data
                        </div>




                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="15%">Contact Address</th>
                                    <th scope="col" width="25%">Contact Email</th>
                                    <th scope="col" width="15%">Contact Phone</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($contacts as $contact)
                                <tr>
                                    <th scope="row">{{$i++  }}</th>
                                    <td>{{ $contact->address }}</td>
                                    

                                    <!-- <td>{{-- $brand->name --}}</td> -->
                                    
                                    <td>
                                    
                                            {{ $contact->email }}
                                    </td>
                                    <td>
                                    
                                    {{ $contact->phone }}
                            </td>
                                      </td>
                                    <td>
                                    <a href="{{url('admin/contact/edit/'.$contact->id)}}" class='btn btn-info'>Edit</a>
                                    <a href="{{url('admin/contact/delete/'.$contact->id)}}" onclick='return confirm("Are you sure to delete?")' class='btn btn-danger'>Delete</a>
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