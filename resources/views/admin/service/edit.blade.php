@extends('admin.admin_master')
@section('admin')

<div class="py-12">


    <div class='container'>
        <div class="row">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Service
                    </div>
                    <div class="card-body">
                        <form action="{{ url('services/'.$service->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name='old_image' value="{{ $service->image}}">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Update Service Name</label>
                                <input type="text" name='name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $service->name}}">

                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Update Service Description</label>
                                <textarea type="text" name='description' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                    {{ $service->description }}
                                </textarea>

                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Update Service Image</label>
                                <input type="file" name='image' class="form-control" id="service-image-id" aria-describedby="emailHelp" value="{{ $service->image}}" >

                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img  id='visible-img-id' src="{{ asset($service->image)}}" style='width:400px; height:200px;'>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Service</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
<script defer>
document.getElementById('service-image-id').addEventListener('change',readURL);
let imgSlider = document.getElementById("visible-img-id");
function readURL(input) {
    input = input.currentTarget;
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