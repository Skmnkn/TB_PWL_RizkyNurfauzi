@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
<h1 class="text-center text-bold">ITEM MANAGEMENT</h1>
@stop

@section('content')
{{-- Table Product --}}
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <button class="btn btn-primary float-left mr-3" data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Add Data</button>
          <div class="btn-group mb-5" role="group" aria-label="Basis Example">
          </div>
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
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; 
              @endphp
              @foreach($barang as $key)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$key->name}}</td>
                <td>{{$key->categories_id}}</td>
                <td>{{$key->total}}</td>
                <td>
                  {{$key->brands_id}}
                </td>
                <td>
                  @if($key->photo !== null)
                  <img src="{{ asset('storage/product_photo/'.$key->photo) }}" width="100px" />
                  @else
                  [Picture Not Found]
                  @endif
                </td>
                <td>{{$key->harga}}</td>
                <td>{{$key->stock}}</td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" id="btn-edit-product" class="btn btn-success" data-toggle="modal" data-target="#editBukuModal" data-id="{{ $key->id }}">Edit</button>
                    <button type="button" id="btn-delete-product" class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal" data-id="{{ $key->id }}" data-photo="{{ $key->photo }}">Delete</button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- End Table Product --}}

{{-- Modal Add Product --}}
<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12">
        <form method="post" action="{{ route('admin.product.submit') }}" enctype="multipart/form-data">
          @csrf
            <div class="row">
              <div class="form-group col-md-4 mr-auto">
                <label for="name">Nama</label>
                <input type="text" placeholder="Masukan Nama Barang" class="form-control" name="name" id="name" required />
              </div>
              <div class="form-group col-md-4 ml-auto">
                <label for="total">Jumlah</label>
                <input type="number" min="0" class="form-control" placeholder="Masukan Jumlah" name="total" id="total" required />
              </div>
              <div class="form-group col-md-4">
                <label for="harga">Harga</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" name="harga" min="0" placeholder="Masukan Harga" class="form-control" aria-label="Amount (to the nearest dollar)">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="categories_id">Kategori</label>
                <!-- <input type="text" class="form-control" name="penerbit" id="penerbit" required /> -->
                <div class="input-group">
                  <select class="custom-select" name="categories_id" placeholder="Masukan Kategori barang" id="categories_id_add" aria-label="Example select with button addon">
                    <option selected>Pilih Kategori</option>
                    @php
                        $data = App\Models\Categories::get();
                    @endphp
                    @foreach ($data as $Cat)
                      <option value="{{$Cat->id}}"->{{$Cat->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group col-md-4">
                <label for="brands_id">Merek</label>
                <!-- <input type="text" class="form-control" name="penerbit" id="penerbit" required /> -->
                <div class="input-group">
                  <select class="custom-select"  name="brands_id" placeholder="Masukan Nama Brands" id="brands_id_add" aria-label="Example select with button addon">
                    <option selected>Pilih Merek</option>
                    @php
                        $data = App\Models\Brands::get();
                    @endphp
                    @foreach ($data as $Bran)
                      <option value="{{$Bran->id}}"->{{$Bran->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group col-md-4">
                <label for="stock">Stock Barang</label>
                <div class="input-group">
                  <select class="custom-select" name="stock" placeholder="Masukan Keterangan Stock" id="stock_add" aria-label="Example select with button addon">
                    <option selected>Pilih Merek</option>
                    <option>READY</option>
                    <option>EMPTY</option>
                  </select>
                </div>
                {{-- <input type="text" class="form-control" name="stock" id="stock" required/> --}}
              </div>
            </div>
          <div class="form-group">
            <label for="photo">Photo Barang</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="custom-file">
                  <input type="file" class="custom-file-input form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" name="photo" id="photo">
                  <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- End Modal Add Product --}}

{{-- Modal Edit Product --}}
<div class="modal fade" id="editBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.product.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
            <div class="row">
              <div class="form-group col-md-4">
                <label for="name">Nama</label>
                <input type="text" placeholder="Masukan Nama Barang" class="form-control" name="name" id="name_edit" required />
              </div>
              <div class="form-group col-md-4">
                <label for="total">Jumlah</label>
                <input type="number" min="0" class="form-control" placeholder="Masukan Jumlah" name="total" id="total_edit" required />
              </div>
              <div class="form-group col-md-4">
                <label for="harga">Harga</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" name="harga" min="0" placeholder="Masukan Harga" id="harga_edit" class="form-control" aria-label="Amount (to the nearest dollar)">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="categories_id">Kategori</label>
                <!-- <input type="text" class="form-control" name="penerbit" id="penerbit" required /> -->
                <div class="input-group">
                  <select class="custom-select" name="categories_id" placeholder="Masukan Kategori barang" id="categories_id_edit" aria-label="Example select with button addon">
                    <option selected>Pilih Kategori</option>
                    @php
                        $data = App\Models\Categories::get();
                    @endphp
                    @foreach ($data as $Cat)
                      <option value="{{$Cat->id}}">{{$Cat->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group col-md-4">
                <label for="brands_id">Merek</label>
                <!-- <input type="text" class="form-control" name="penerbit" id="penerbit" required /> -->
                <div class="input-group">
                  <select class="custom-select"  name="brands_id" placeholder="Masukan Nama Brands" id="brands_id_edit" aria-label="Example select with button addon">
                    <option selected>Pilih Merek</option>
                    @php
                        $data = App\Models\Brands::get();
                    @endphp
                    @foreach ($data as $Bran)
                      <option value="{{$Bran->id}}">{{$Bran->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group col-md-4">
                <label for="stock">Stock Barang</label>
                <div class="input-group">
                  <select class="custom-select" name="stock" placeholder="Masukan Keterangan Stock" id="stock_edit" aria-label="Example select with button addon">
                    <option selected>Pilih Merek</option>
                    <option>READY</option>
                    <option>EMPTY</option>
                  </select>
                </div>
                {{-- <input type="text" class="form-control" name="stock" id="stock" required/> --}}
              </div>
            </div>
          <div class="form-group">
            <label for="photo">Photo Barang</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="custom-file">
                  <input type="file" class="custom-file-input form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" name="photo" id="edit-photo">
                  <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                </div>
              </div>
            </div>
          </div>
      </div>
          <div class="modal-footer">
            <input type="hidden" name="id" id="edit-id" />
            <input type="hidden" name="old-photo" id="edit-old-photo" />
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- End Modal Edit Product --}}

{{-- Modal Delete Product --}}
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Data Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to delete <strong class="font-italic" id="delete-name"></strong>?
        <form method="post" action="{{ route('admin.product.delete') }}" enctype="multipart/form-data">
          @csrf
          @method('DELETE')
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" id="delete-id" value="" />
        <input type="hidden" name="old_photo" id="delete-old-photo" />
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>



@stop
@section('js')
<script>
  $(function() {
    
    $(document).on('click', '#btn-delete-product', function() {
      let id = $(this).data('id');
      let photo = $(this).data('photo');
      let name = $(this).data('name');
      $('#delete-id').val(id);
      $('#delete-old-photo').val(photo);
      $('#delete-name').text(name);
    });

    $(document).on('click', '#btn-edit-product', function() {
      let id = $(this).data('id');

      $('#image-area').empty();

      $.ajax({
        type: "get",
        url: baseurl + '/admin/ajaxadmin/product/' + id,
        dataType: 'json',
        success: function(res) {
          $('#name_edit').val(res.name);
          $('#stock_edit').val(res.stock);
          $('#harga_edit').val(res.harga);
          $('#brands_id_edit').val(res.brands_id);
          $('#categories_id_edit').val(res.categories_id);
          $('#total_edit').val(res.total);
          $('#edit-old-photo').val(res.photo);
          $('#edit-id').val(res.id);

          if (res.photo !== null) {
            $('#image-area').append(
              "<img src='" + baseurl + "/storage/product_photo/" + res.photo + "' width='200px'/>"
            );
          } else {
            $('#image-area').append('[Gambar tidak tersedia]');
          }
        },
      });
    });

  });
</script>
@stop
@section('js')
<script>

</script>
@stop