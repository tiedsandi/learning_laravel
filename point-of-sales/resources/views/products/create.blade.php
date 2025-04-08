@extends('layouts.main')
@section('title','Add Product')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">@yield('title')</h5>

          <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="" class='col-form-label'>Product Name*</label>
              <input type="text" class="form-control" name="product_name" placeholder="Enter your product Name" required>
            </div>
            <div class="mb-3">
              <label for="" class='col-form-label'>Category Name*</label>
              <select name="category_id" class="form-select" required>
                <option value="">Select Category</option>

                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="" class='col-form-label'>Product Price*</label>
              <input type="number" class="form-control" name="product_price" placeholder="Enter your product Price" required>
            </div>
            <div class="mb-3">
              <label for="" class='col-form-label'>Product Description</label>
              <input type="text" class="form-control" name="product_description" placeholder="Enter your product Price">
            </div>
            <div class="mb-3">
              <label for="" class='col-form-label'>Product Photo</label>
              <input type="file" name="photo" class="form-control">
            </div>
            <div class="mb-3">
              <label for="" class='col-form-label'>Status *</label>
              <br>
              <input type="radio" name="is_active" value="1" checked> Active
              <input type="radio" name="is_active" value="0"> Inactive
            </div>
            <div class="mb-3">
              <button class="btn btn-primary" type="submit">Save</button>
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