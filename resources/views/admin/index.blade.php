@extends('admin.admin_master')

@section('admin')
<!-- Top Statistics -->

<div class="row">
    <div class="card col-12 col-md-4" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Home about</h5>
            <p class="card-text">Set the company description</p>
            <a href="{{ route('home.about') }}" class="card-link">Edit</a>
        </div>
    </div>
    <div class="card col-12 col-md-4" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Slider</h5>
            <p class="card-text">Set the company description</p>
            <a href="{{ route('home.slider') }}" class="card-link">Edit</a>
        </div>
    </div>
    <div class="card col-12 col-md-4" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Services</h5>
            <p class="card-text">Services offered</p>
            <a href="{{ url('services') }}" class="card-link">Edit</a>
        </div>
    </div>
    <div class="card col-12 col-md-4" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Home Portfolio</h5>
            <p class="card-text">Company projects</p>
            <a href="{{ route('multi.image')}}" class="card-link">Edit</a>
        </div>
    </div>
    <div class="card col-12 col-md-4" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Home Brand</h5>
            <p class="card-text">Brands that the company worked for</p>
            <a href="{{ route('all.brand') }}" class="card-link">Edit</a>
        </div>
    </div>
    <div class="card col-12 col-md-4" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Contact Profile</h5>
            <p class="card-text">Contact information of the company (address, phone, email)</p>
            <a href="{{route('admin.contact')}}" class="card-link">Edit</a>
        </div>
    </div>
    <div class="card col-12 col-md-4" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Contact Message</h5>
            <p class="card-text">Messages received</p>
            <a href="{{route('admin.message')}}" class="card-link">Edit</a>
        </div>
    </div>





    @endsection