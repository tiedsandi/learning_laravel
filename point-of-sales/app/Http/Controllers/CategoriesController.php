<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Categories dari controller";
        $datas = Categories::get();
        return view('categories.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Categories::create([
            'category_name' => $request->category_name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->to('categories');
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
        $edit =  Categories::findorFail($id); // find, findorfail, where
        return view('categories.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Categories::where('id',$id)->update([
        //     'category_name' => $request->category_name
        // ]);

        $category = Categories::find($id);
        $category->category_name = $request->category_name;
        $category->is_active = $request->is_active;
        $category->save();

        return redirect()->to('categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Categories::where('id',$id)->delet();
        $category = Categories::find($id);
        $category->delete();
        return redirect()->to('categories');
    }
}
