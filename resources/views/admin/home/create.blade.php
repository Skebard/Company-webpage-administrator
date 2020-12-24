@extends('admin.admin_master')
@section('admin')
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create About</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('store.about')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">About title</label>
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="text" name='title' class="form-control" id="exampleFormControlInput1" placeholder="About title">
                </div>


                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Short Description</label>
                    @error('short_description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <textarea class="form-control" name='short_description' id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Long Description</label>
                    @error('long_description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <textarea class="form-control" name='long_description' id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>

                </div>
            </form>
        </div>
    </div>

    @endsection