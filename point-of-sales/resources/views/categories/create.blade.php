@extends('layouts.main')
@section('title','Add New Categories')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">@yield('title')</h5>

          <form action="{{route('categories.store')}}" method="post">
            @csrf
            <div class="mb-3">
              <label for="" class='col-form-label'>Category Name*</label>
              <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" required>
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