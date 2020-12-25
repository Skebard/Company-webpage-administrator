@extends('admin.admin_master')
@section('admin')
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit Contact</h2>
        </div>
        <div class="card-body">

        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
            <form action="{{ url('admin/contact/update/'.$contact->id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Contact Email</label>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input  value='{{ $contact->email}}' type="email" name='email' class="form-control" id="exampleFormControlInput1" placeholder="Contact Email">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Contact Phone</label>
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input value='{{ $contact->phone}}' type="text" name='phone' class="form-control" id="exampleFormControlInput1" placeholder="Contact Phone">
                </div>



                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Contact address</label>
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <textarea class="form-control" name='address' id="exampleFormControlTextarea1" rows="3">
                    {{ $contact->address}}

                    </textarea>
                </div>


                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Update</button>

                </div>
            </form>
        </div>
    </div>

    @endsection