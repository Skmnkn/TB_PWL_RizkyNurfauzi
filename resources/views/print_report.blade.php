<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
    <h1 class="text-center">Data Report</h1>
    <p class="text-center">Data of Product in 2021</p>
    <br>
    <table id="table-data" class="table table-bordered">
        <thead>
            <tr>
              <th>NO</th>
              <th>MEREK</th>
              <th>NAMA</th>
              <th>KATEGORI</th>
              <th>JUMLAH</th>
              <th>FOTO</th>
              <th>HARGA</th>
              <th>STOCK</th>
            </tr>
          </thead>
          <tbody>
            @php $no=1; 
            @endphp
            @foreach($report as $key)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$key->name}}</td>
              <td>{{$key->view_kategori->name}}</td>
              <td>{{$key->total}}</td>
              <td>
                {{$key->view_merek->name}}
              </td>
              <td>
                @if($key->photo !== null)
                <img src="{{ public_path('storage/product_photo/'.$key->photo) }}" width="80px" />
                @else
                [Picture Not Found]
                @endif
              </td>
              <td>{{$key->harga}}</td>
              <td>{{$key->stock}}</td>
            </tr>
            @endforeach
          </tbody>
    </table>
</body>
</html>