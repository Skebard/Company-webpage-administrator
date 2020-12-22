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
                        Edit Slider
                    </div>
                    <div class="card-body">
                        <form action="{{ url('slider/update/'.$slider->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name='old_image' value="{{ $slider->image}}">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Update Slider Title</label>
                                <input type="text" name='title' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $slider->title}}">

                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Update Slider Description</label>
                                <input type="text" name='description' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $slider->description}}">

                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slider-image-id" class="form-label">Update Slider Image</label>
                                <input type="file" name='image' class="form-control" id="slider-image-id" aria-describedby="emailHelp" value="{{ $slider->image}}" onchange="readURL(this);">

                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img id='visible-img-id' src="{{ asset($slider->image)}}" style='width:400px; height:200px;'>
                            </div>
                            <button type="submit" class="btn btn-primary">Update slider</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>




</div>
<script defer>
// document.getElementById('slider-image-id').addEventListener('change',updateImage);
let imgSlider = document.getElementById("visible-img-id");
// input = e.currentTarget
function readURL(input) {
    console.log(input);
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imgSlider.src = e.target.result;

            };
            reader.readAsDataURL(input.files[0]);

        }
    }
</script>
@endsection