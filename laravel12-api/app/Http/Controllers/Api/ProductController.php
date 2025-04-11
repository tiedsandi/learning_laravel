<?php

namespace App\Http\Controllers\Api;

//import model Product
use App\Models\Product;

use App\Http\Controllers\Controller;

//import resource ProductResource
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all products
        $products = Product::latest()->paginate(5);

        //return collection of products as a resource
        return new ProductResource(true, 'List Data Products', $products);
    }
}
