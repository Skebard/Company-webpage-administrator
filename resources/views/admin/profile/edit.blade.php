@extends('admin.admin_master')
@section('admin')

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>My Profile</h2>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form action='{{ route("update.profile")}}' method='post' class="form-pill" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlPassword3">Username</label>
                <input type="text" class="form-control" id="current_password" name="name" value="{{ $user->name}}">
                @error('name')
                <span class='text-danger'>{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleFormControlPassword3">Email</label>
                <input type="email" class="form-control" id="current_password" name="email" value="{{ $user->email}}">
                @error('email')
                <span class='text-danger'>{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slider-image-id" class="form-label">Profile Image</label>
                <input type="file" name='image' class="form-control" id="slider-image-id" aria-describedby="emailHelp" value="{{ $user->profile_photo_path}}" onchange="readURL(this);">

                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                                <img id='visible-img-id' src="{{ asset('storage/'.$user->profile_photo_path)}}" style='width:400px; height:200px;'>
                            </div>
            <button type='submit' class="btn btn-primary default">Update</button>
        </form>
    </div>
</div>
@endsection