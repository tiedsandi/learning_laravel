<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=\, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Print Struk</title>

  <style>
  body {
    font-family: Arial, sans-serif;
    font-size: 12px;
    margin: 0;
    padding: 0;
    color: #333;
  }

  .wrapper {
    width: 140mm;
    margin: auto;
    padding: 10px;
    border: 1px solid #ddd;
    background: #fff;
  }

  header {
    text-align: center;
    margin-bottom: 10px;
  }

  header h3 {
    margin: 0;
    font-size: 16px;
  }

  header p {
    margin: 2px 0;
    font-size: 12px;
  }

  hr {
    border: none;
    border-top: 1px dashed #ddd;
    margin: 10px 0;
  }

  section h4 {
    margin: 5px 0;
    font-size: 14px;
    text-decoration: underline;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 5px;
  }

  table th, table td {
    padding: 5px;
    font-size: 12px;
  }

  table th {
    border-bottom: 1px solid #ddd;
  }

  table td {
    border-bottom: 1px dashed #ddd;
  }

  footer {
    text-align: center;
    margin-top: 10px;
  }

  footer p {
    margin: 0;
    font-size: 12px;
  }

  @media print {
    body {
      margin: 0;
      padding: 0;
      color: #000;
    }

    .wrapper {
      border: none;
      width: 100%;
      padding: 0;
    }

    header, footer {
      page-break-inside: avoid;
    }

    table th, table td {
      font-size: 10px;
    }

    hr {
      border-top: 1px dashed #000;
    }
  }

</style>

</head>
<body onload="window.print()">
  <div class="wrapper">
    <header>
      <h3>Toko AKO</h3>
      <p>Jl. Contoh Alamat No. 123</p>
      <p>Telp: 08123456789</p>
    </header>
    <hr>
    <section>
      <h4>Order Details</h4>
      <p><strong>Order ID:</strong> {{ $order->id }}</p>
      <p><strong>Date:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
    </section>
    <hr>
    <section>
      <h4>Items</h4>
      <table style="width: 100%; border-collapse: collapse;">
        <thead>
          <tr>
            <th style="text-align: left;">Item</th>
            <th style="text-align: right;">Qty</th>
            <th style="text-align: right;">Price</th>
            <th style="text-align: right;">Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orderDetails as $detail)
            <tr>
              <td>{{ $detail->product->product_name }}</td>
              <td style="text-align: right;">{{ $detail->qty }}</td>
              <td style="text-align: right;">{{ number_format($detail->order_price, 2) }}</td>
              <td style="text-align: right;">{{ number_format($detail->order_subtotal, 2) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </section>
    <hr>
    <section>
      <p><strong>Subtotal:</strong> {{ number_format($order->order_amount, 2) }}</p>
      <p><strong>Tax (2.5%):</strong> {{ number_format($order->order_amount * 0.025, 2) }}</p>
      <p><strong>Total:</strong> {{ number_format($order->order_amount + ($order->order_amount * 0.025), 2) }}</p>
    </section>
    <footer>
      <p>Thank you for shopping with us!</p>
    </footer>
  </div>
</body>
</html>