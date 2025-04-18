<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{$title ?? ''}}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  @include('sweetalert::alert')

  @include('layouts.inc.header')
  @include('layouts.inc.sidebar')



  <main id="main" class="main">

    <div class="pagetitle">
      <h1>
        @yield('title')
      </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @yield('content')


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/quill/quill.js')}}"></script>
  <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

  
  
  <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>

  <script>

    function formatRupiah(num){
      return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(num);
    }

    $(document).ready(function() {
      $('.rupiah-format').each(function() {
          var value = parseFloat($(this).text());
          if (!isNaN(value)) {
              $(this).text(formatRupiah(value));
          }
      });
    });

    $('#category_id').change(function(){
      let cat_id = $(this).val(), option = '<option value="">Select Product</option>';
      
      $.ajax({
        url: '/get-product/' + cat_id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          $.each(data.data, function(index,value){
            option += `<option value="${value.id}" data-img="${value.product_photo}" data-price="${value.product_price}">${value.product_name}</option>`;
          })
          $('#product_id').html(option);
        },
        error: function(xhr, status, error) {
          console.error('Error fetching subcategories:', error);
        }
      });
    })

    $(".add-row").click(function(){
      let tbody = $('tbody')
      let selectedOption = $('#product_id').find('option:selected');
      let namaProduk = selectedOption.text();
      let productId = selectedOption.val();
      let gambarProduk = selectedOption.data('img');
      let hargaProduk =  parseInt(selectedOption.data('price'));

      if($('#category_id').val()==""){
        alert('Category required');
        return false;
      }

      if($('#product_id').val()==""){
        alert('Product required');
        return false;
      }

      let newRow = "<tr>";
        newRow += `<td><img width="110px" src="{{asset('storage/')}}/${gambarProduk}" alt="ini gambar"></td>`
        newRow += `<td>${namaProduk} <input type="hidden"name="product_id[]" value="${productId}" ></td>`
        newRow += `<td><input type="number" value="1" name="qty[]" class="qty form-control"></td>`
        newRow += `<td>
                    <input type="hidden" name="order_price[]" value="${hargaProduk}" >
                    <span class="price" data-price=${hargaProduk}>${formatRupiah(hargaProduk)}</span>
                  </td>`
        newRow += `<td>
                    <input class="subtotal_input" type="hidden" name="order_subtotal[]" value="${hargaProduk}">
                    <span class="subtotal">${formatRupiah(hargaProduk)}</span>
                  <td>`
        newRow += `</tr>`

        tbody.append(newRow);


        sumSubTotal();
        clearAll();

        $('.qty').on('input',function(){
          let row = $(this).closest('tr');
          let qty = parseInt($(this).val()) || 0;
          let price = parseInt(row.find('.price').data('price')) || 0;
          let total = price * qty
          row.find('.subtotal').text(formatRupiah(total));
          row.find('.subtotal_input').val(total);
          sumSubTotal();
        })
    })

    function sumSubTotal(){
      let grandtotal = 0;

      $('.subtotal').each(function(){
        let total = $(this).text().split(',');
        let valueWithoutRp = parseInt(total[0].replace('Rp', '').replace(/\./g, '').trim());        
        grandtotal += valueWithoutRp;
      })
      
      $('.grandtotal').text(formatRupiah(grandtotal));
      $('input[name="grandTotal"]').val(grandtotal);
    }

    function clearAll(){
      $('#category_id').val("");
      $('#product_id').val("");
    }

    // $('#category_id').change(function(){
    //   let cat_id = $(this).val();
    //   // Reset the #product_id dropdown
    //   $('#product_id').empty().append('<option value="">Select Product</option>');
      
    //   if (cat_id) {
    //   $.ajax({
    //     url: '/get-product/' + cat_id,
    //     type: 'GET',
    //     dataType: 'json',
    //     success: function(data) {
    //     $.each(data.data, function(index, value){
    //       $('#product_id').append(`<option value='${value.id}'>${value.product_name}</option>`);
    //     });
    //     },
    //     error: function(xhr, status, error) {
    //     console.error('Error fetching products:', error);
    //     }
    //   });
    //   }
    // });
  </script>


</body>

</html>