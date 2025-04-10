@extends('layouts.main')
@section('title','Point Of Sale')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-5">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Select Categories</h5>
          <div class="mt-2" align="right">
            <a href="{{url()->previous()}}" class="text-primary">Back</a>
          </div>
          <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="" class='col-form-label'>Category Name*</label>
              <select name="category_id" id="category_id" class="form-select" required>
                <option value="">Select Category</option>

                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="" class='col-form-label'>Product Name*</label>
              <select name="product_id" id="product_id" class="form-select" required>
                <option value="">Select One</option>
              </select>
            </div>

            <div class="mb-3">
              <button class="btn btn-primary add-row" type="button">Add to Cart</button>
              <button class="btn btn-danger" type="reset">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-7">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Order Cart</h5>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Foto</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>SubTotal</th>
              </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
              <tr>
                <th colspan="4">Grand Total</th>
                <td >
                  <span class="grandtotal"></span>
                  <input type="hidden" name="grandtotal" class=" form-control">
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection