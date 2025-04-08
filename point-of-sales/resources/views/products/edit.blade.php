@extends('layouts.main')
@section('title','Edit Products')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">@yield('title')</h5>

          <form action="{{route('product.update', $edit->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
              @if($edit->product_photo)
              <img src="{{asset('storage/'.$edit->product_photo)}}" alt="" width="100px" height="100px" style="object-fit:contain">
              @else
              <img src="{{asset('images/no-image.png')}}" alt="" width="100px" height="100px" style="object-fit:contain">
              @endif
            </div>

            <div class="mb-3">
              <label for="" class='col-form-label'>Product Name*</label>
              <input type="text" class="form-control" name="product_name" placeholder="Enter your product Name" required
                value="{{$edit->product_name}}">
            </div>

            <div class="mb-3">
              <label for="" class='col-form-label'>Category Name*</label>
              <select name="category_id" class="form-select" required>
                <option value="">Select Category</option>

                @foreach($categories as $category)
                <option value="{{$category->id}}"
                  @selected($category->id == $edit->category_id)>
                  {{$category->category_name}}
                </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="" class='col-form-label'>Product Price*</label>
              <input type="number" class="form-control" name="product_price" placeholder="Enter your product Price" required
                value="{{$edit->product_price}}">
            </div>
            <div class="mb-3">
              <label for="" class='col-form-label'>Product Description</label>
              <input type="text" class="form-control" name="product_description" placeholder="Enter your product Price"
                value="{{$edit->product_description}}">
            </div>
            <div class="mb-3">
              <label for="" class='col-form-label'>Product Photo</label>
              <input type="file" name="photo" class="form-control">
            </div>
            <div class="mb-3">
              <label for="" class='col-form-label'>Status *</label>
              <br>
              <input type="radio" name="is_active" value="1" @checked($edit->is_active == 1)> Publish
              <input type="radio" name="is_active" value="0" @checked($edit->is_active == 0)> Draft
            </div>
            <div class="mb-3">
              <button class="btn btn-primary" type="submit">Edit</button>
              <button class="btn btn-danger" type="reset">Reset</button>
              <a href="{{url()->previous()}}" class="text-primary">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection