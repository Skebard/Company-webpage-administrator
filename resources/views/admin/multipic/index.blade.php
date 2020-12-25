
@extends('admin.admin_master')
@section('admin')
    <div class="py-12">


        <div class='container'>
            <div class="row">

                <div class="col-md-8">
                    
                <div class="card-group">
                    @foreach($images as $image)
                    <div class="col-md-4 mt-5">
                        <div class="card">
                            <img src="{{asset($image->image)}}" alt="">
                        </div>
                    </div>

                    @endforeach
                </div>
                </div>




                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Brand
                        </div>
                        <div class="card-body">
                            <form action="{{route('store.image')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                             

                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Multi Image</label>
                                    <input type="file" name='image[]' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" multiple=''>
                                
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>


                                <button type="submit" class="btn btn-primary">Add image</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>







    </div>
@endsection