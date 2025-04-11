@extends('layouts.main')
@section('title','Data Pos')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h3 class="card-title">@yield('title')</h3>
          <!-- <h5 class="card-title">{{$subTitle ?? 'sub-Data'}}</h5>
            <h6 class="card-title">@yield('litleTitle')</h6> -->

          <div class="mt-4 mb-3">
            <div align='right' class="mb-3">
              <a href="{{route('pos.create')}}" class="btn btn-primary">Add Pos</a>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Order Code</th>
                  <th>Order Date</th>
                  <th>Amount</th>
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
                  <td>{{$data->order->order_code}}</td>
                  <td>{{$data->order->order_date}}</td>
                  <td>{{$data->order->order_amount}}</td>
                  <td>
                    {{
                      $data->order->order_status ? 'Paid' : 'Unpaid'
                    }}
                  <td>
                    <a href="{{route('pos.show', $data->id)}}" class="btn btn-sm btn-secondary">
                      <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{route('pos.edit', $data->id)}}" class="btn btn-sm btn-success">
                      <i class="bi bi-printer"></i>
                    </a>
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