<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\orderDetails;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = orderDetails::with('order')->orderBy('id', 'desc')->get();
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
        $qOrderCode = Orders::max('id');
        $qOrderCode++;
        $orderCode = "ORD" . date('dmY') . sprintf("%03d", $qOrderCode);

        $data = [
            'order_code' => $orderCode,
            'order_date' => date("Y-m-d"),
            'order_amount' => $request->grandTotal,
            'order_change' => 1,
            'order_status' => 1,
        ];

        $order = Orders::create($data);

        $qty = $request->qty;
        foreach ($qty as $key => $quantity) {
            orderDetails::create([
                'order_id' => $order->id,
                'product_id' => $request->product_id[$key],
                'qty' => $request->qty[$key],
                'order_price' => $request->order_price[$key],
                'order_subtotal' => $request->order_subtotal[$key],
            ]);
        }

        Alert::success('Order Created Successfully', 'The order has been created successfully.');
        return redirect()->to('pos');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Orders::findorFail($id);
        $orderDetails = orderDetails::with('product')->where('order_id', $id)->get();
        // return $orderDetails;
        $title = "Order Details Of " . $order->order_code;
        return view('pos.show', compact('order', 'orderDetails', 'title'));
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

    public function print($id)
    {
        $order = Orders::findorFail($id);
        $orderDetails = orderDetails::with('product')->where('order_id', $id)->get();

        return view('pos.print-struk', compact('order', 'orderDetails'));
    }
}
