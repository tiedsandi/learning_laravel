@extends('layouts.main')
@section('title','Data Produk')

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
              <a href="{{route('product.create')}}" class="btn btn-primary">Add Product</a>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Foto</th>
                  <th>Nama Kategori</th>
                  <th>Nama Produk</th>
                  <th>Harga</th>
                  <th>Status</th>
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
                  <td>
                    @if($data->product_photo)
                    <img src="{{asset('storage/'.$data->product_photo)}}" alt="" width="100px" height="100px" style="object-fit:contain">
                    @else
                    <img src="{{asset('images/no-image.png')}}" alt="" width="100px" height="100px" style="object-fit:contain">
                    @endif
                  </td>
                  <td>{{$data->cate->category_name}}</td>
                  <td>{{$data->product_name}}</td>
                  <td>{{$data->product_price}}</td>
                  <td>
                    {{
                      $data->is_active ? 'Publish' : 'Draft'
                    }}
                  <td>
                    <a href="{{route('product.edit', $data->id)}}" class="btn btn-sm btn-secondary">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" class='d-inline' action="{{route('product.destroy', $data->id)}}" method="post">
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