<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Products;
use App\Models\Categories;
use RealRashid\SweetAlert\Facades\Alert;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Products::with('cate')->get();
        // return $datas;
        return view('products.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::orderBy('category_name', 'asc')->get();
        // $categories = Categories::where('is_active', 1)->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'product_price' => 'required|numeric',
            'is_active' => 'required|boolean',
            'product_description' => '',
        ]);

        $data = [
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'is_active' => $request->is_active,
        ];

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('products', 'public');
            $data['product_photo'] = $photo;
        }

        Products::create($data);
        return redirect()->to('product')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Products::findOrFail($id);
        $categories = Categories::orderBy('category_name', 'asc')->get();
        return view('products.edit', compact('edit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'product_price' => 'required|numeric',
            'is_active' => 'required|boolean',
            'product_description' => '',
        ]);

        $data = [
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'is_active' => $request->is_active,
        ];
        $product = Products::findOrFail($id);

        if ($request->hasFile('photo')) {
            if ($product->product_photo) {
                File::delete(public_path('storage/' . $product->product_photo));
            }

            $photo = $request->file('photo')->store('products', 'public');
            $data['product_photo'] = $photo;
        }

        $product->update($data);
        // Alert::alert('Title', 'Message', 'Type');
        // Alert::warning('Warning Title', 'Warning Message');
        Alert::success('Success Title', 'Success Message');

        // Alert::toast('Sucess', 'Edit Sucessfully');
        return redirect()->to('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::findOrFail($id);

        File::delete(public_path('storage/' . $product->product_photo));
        $product->delete();

        return redirect()->to('product')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
