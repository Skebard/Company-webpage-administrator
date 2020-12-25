@extends('admin.admin_master')
@section('admin')

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Change Password</h2>
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
        <form action='{{ route("update.password")}}' method='post' class="form-pill">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlPassword3">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
                @error('current_password')
                <span class='text-danger'>{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlPassword3">New Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder=" New Password">
                @error('password')
                <span class='text-danger'>{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlPassword3">New Password Confirmation</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmation Password">
                @error('password_confirmation')
                <span class='text-danger'>{{$message}}</span>
                @enderror
            </div>
            <button type='submit' class="btn btn-primary default">Save</button>
        </form>
    </div>
</div>
@endsection