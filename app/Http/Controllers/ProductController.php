<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;
use App\Models\Brands;



class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $barang = Product::all();
        return view('product', compact('user', 'barang'));
    }

    public function add_product(Request $req)
    {

        $barang = new Product;

        $barang->name = $req->get('name');
        $barang->brands_id = $req->get('brands_id');
        $barang->categories_id = $req->get('categories_id');
        $barang->harga = $req->get('harga');
        $barang->stock = $req->get('stock');
        $barang->total = $req->get('total');

        if ($req->hasFile('photo')) {
            $extension = $req->file('photo')->extension();

            $filename = 'product_photo_' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/product_photo',
                $filename
            );

            $barang->photo = $filename;
        }
        $barang->save();

        $notification = array(
            'message' => 'Product Add Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.product')->with($notification);
    }

    public function update_product(Request $req)
    {

        $barang = Product::find($req->get('id'));

        $barang->name = $req->get('name');
        $barang->brands_id = $req->get('brands_id');
        $barang->categories_id = $req->get('categories_id');
        $barang->harga = $req->get('harga');
        $barang->stock = $req->get('stock');
        $barang->total = $req->get('total');

        if ($req->hasFile('photo')) {
            $extension = $req->file('photo')->extension();

            $filename = 'product_photo_' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/product_photo',
                $filename
            );

            Storage::delete('public/product_photo/' . $req->get('old-photo'));

            $barang->photo = $filename;
        }
        $barang->save();

        $notification = array(
            'message' => 'Product Edit Success!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.product')->with($notification);
    }

    public function getDataProduct($id)
    {
        $barang = Product::find($id);

        return response()->json($barang);
    }

    public function destroy(Request $req)
    {
        $barang = Product::find($req->id);
        Storage::delete('public/product_photo/' . $req->get('old_cover'));
        $barang->delete();

        $notification = array(
            'message' => 'Delete Product Success!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.product')->with($notification);
    }
}
