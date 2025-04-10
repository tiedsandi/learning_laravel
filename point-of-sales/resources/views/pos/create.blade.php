@extends('layouts.main')
@section('title','Point Of Sale')

@section('content')
<section class="section">
  <form action="{{route('pos.store')}}" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-lg-5">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Select Categories</h5>
              @csrf
              <div class="mb-3">
                <label for="" class='col-form-label'>Category Name*</label>
                <select name="category_id" id="category_id" class="form-select">
                  <option value="">Select Category</option>

                  @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->category_name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="" class='col-form-label'>Product Name*</label>
                <select name="product_id" id="product_id" class="form-select">
                  <option value="">Select One</option>
                </select>
              </div>

                <div class="mb-3 d-flex justify-content-between">
                <a href="{{url()->previous()}}" class="btn text-primary">Back</a>
                <button class="btn btn-primary add-row" type="button">Add to Cart</button>
                </div>
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
                      <input type="text" name="grandTotal" class="form-control">
                    </td>
                  </tr>
                </tfoot>
              </table>
              <div class="mt-3" align="right">
                <button type="submit" class="btn btn-success">Confirm Order</button>
                <input type="hidden" name="grandTotal">
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </form>
</section>
@endsection