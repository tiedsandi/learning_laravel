<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Orders::orderBy('id', 'desc')->get();
        // return $datas;
        return view('pos.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::orderBy('category_name', 'asc')->get();
        return view('pos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getProduct(string $category_id)
    {
        $products = Products::where('category_id', $category_id)->get();
        $response = ['status' => 'success', 'message' => 'Fetch product success', 'data' => $products];
        return response()->json($response, 200);
    }
}
