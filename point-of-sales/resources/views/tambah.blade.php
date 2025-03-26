<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Belajar</title>
</head>
<body>
  <h1>Form Tambah</h1>
  <form action="/action-tambah" method="post">
    @csrf
    <label for="">Angka 1</label>
    <input type="number" name="angka12">
    <br><br>
    <label for="">Angka 2</label>
    <input type="number" name="angka2">
    <br>
    <button type="submit">Tambah</button>
  </form>

  <br><br>
  <h3>Totalnya adalah: {{$jumlah}}</h3>

</body>
</html>