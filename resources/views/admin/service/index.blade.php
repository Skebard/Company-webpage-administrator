@extends('admin.admin_master')
@section('admin')
<div class="py-12">


    <div class='container'>
        <div class="row">

            <div class="col-md-8">
                <div class="card">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="card-header">
                        Services
                    </div>




                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach($services as $service)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $service->name }}</td>

                                <td><img src="{{ asset($service->image)}}" style='height:40px; width:70px' alt="">
                                </td>
                                <!-- <td>{{-- $brand->name --}}</td> -->

                                <td>

                                    {{ $service->description }}

                                </td>
                                <td>
                                    <a href="{{url('services/'.$service->id.'/edit')}}" class='btn btn-info'>Edit</a>
                                    <form action="{{url('services/'.$service->id)}}" method='post'>
                                        @csrf
                                        @method('delete')
                                        <input  class='btn btn-danger' type='submit' value='Delete'>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add Service
                    </div>
                    <div class="card-body">
                        <form action="{{url('services')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Service Name</label>
                                <input type="text" name='name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>




                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Service Description</label>
                                <textarea type="file" name='description' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Service Image</label>
                                <input type="file" name='image' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add service</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>







</div>
@endsection