@extends('layouts.main')
@section('title','Edit User')

@section('content')
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">@yield('title')</h5>

            <form action="{{route('user.update',$edit->id)}}" method="post">
              @csrf
              @method('put')
              <div class="mb-3">
                <label for="" class='col-form-label'>Name*</label>
                <input type="text" class="form-control" name="name" placeholder="Enter your Name" required value="{{$edit->name}}">
              </div>
              <div class="mb-3">
                <label for="" class='col-form-label'>Email*</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" required value="{{$edit->email}}">
              </div>
              <div class="mb-3">
                <label for="" class='col-form-label'>Password</label>
                <input type="text" class="form-control" name="password"  >
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