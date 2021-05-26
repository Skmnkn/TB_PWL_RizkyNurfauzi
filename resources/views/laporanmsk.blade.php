@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
<h1 class="text-center text-bold">ITEM Report</h1>
@stop

@section('content')
{{-- Table Product --}}
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="btn-group mb-5" role="group" aria-label="Basis Example">
          </div>
          <a href="{{ route('admin.print.report')}}" target="_blank" class="btn btn-success mb-5"><i class="fa fa-print"></i> Print to PDF</a>
          <table id="table-data" class="table table-borderer display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>KATEGORI</th>
                <th>JUMLAH</th>
                <th>MEREK</th>
                <th>FOTO</th>
                <th>HARGA</th>
                <th>STOCK</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; 
              @endphp
              @foreach($barang as $key)
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
                  <img src="{{ asset('storage/product_photo/'.$key->photo) }}" width="80px" />
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
        </div>
      </div>
    </div>
  </div>
</div>
@stop