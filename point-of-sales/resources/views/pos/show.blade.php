@extends('layouts.main')
@section('title','Point Of Sale')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3>{{$title ?? ""}}</h3>
          <div>
            <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
            <a href="{{route('print', $order->id)}}" class="btn btn-success">
              <i class="bi bi-printer"></i>
            </a>
          </div>
        </div>
        
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Order</h5>
            <table class="table table-bordered table-striped">
              <tr>
                <th>Order Code</th>
                <td>{{$order->order_code ?? ''}}</td>
              </tr>
              <tr>
                <th>Order Date</th>
                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
              </tr>
              <tr>
                <th>Order Status</th>
                <td>{{$order->order_status ? 'Paid' : 'Unpaid'}}</td>
              </tr>
            </table>
          </div>
        </div>
        
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Order Details</h5>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>SubTotal</th>
                  </tr>
                </thead>

                <tbody>
                    @foreach($orderDetails as $key => $orderDetail)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>
                      @if($orderDetail->product->product_photo)
                        <img src="{{ asset('storage/' . $orderDetail->product->product_photo) }}" alt="Product Image" width="50">
                      @else
                        No Image
                      @endif
                      </td>
                      <td>{{ $orderDetail->product->product_name ?? 'N/A' }}</td>
                      <td>{{ $orderDetail->qty ?? 0 }}</td>
                      <td class="rupiah-format">{{ $orderDetail->product->product_price }}</td>
                      <td class="rupiah-format">{{ ($orderDetail->order_subtotal) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="5">Grand Total</th>
                    <td >
                      <span class="rupiah-format grandtotal">{{$order->order_amount ?? ''}}</span>
                      <input type="hidden" name="grandTotal" class="form-control">
                    </td>
                  </tr>
                </tfoot>
              </table>
              
            </div>
          </div>
        </div>
      </div> 
    </div>
</section>
@endsection