@extends('layouts.main')
@section('title','Data Categories')
@section('subTitle','sub cate')
@section('litleTitle','litle title')

@section('content')
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h3 class="card-title">{{$title ?? 'Data'}}</h3>
            <!-- <h5 class="card-title">{{$subTitle ?? 'sub-Data'}}</h5>
            <h6 class="card-title">@yield('litleTitle')</h6> -->

            <div class="mt-4 mb-3">
              <div align='right' class="mb-3">
                <a href="{{route('categories.create')}}" class="btn btn-primary">Add Categories</a>
              </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no=1; @endphp
                  @foreach($datas as $index => $data)
                    <tr>
                      <td>
                         <!-- {{$index +=1}} -->
                         {{$no ++}}
                      </td>
                      <td>{{$data->category_name}}</td>
                      <td>
                        <a href="{{route('categories.edit', $data->id)}}" class="btn btn-sm btn-secondary">
                          <i class="bi bi-pencil"></i>
                        </a>
                        <form class='d-inline' action="{{route('categories.destroy', $data->id)}}" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-sm btn-warning">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Example Card</h5>
            <p>This is an examle page with no contrnt. You can use it as a starter for your custom pages.</p>
          </div>
        </div>

      </div>

    </div>
  </section>
@endsection


