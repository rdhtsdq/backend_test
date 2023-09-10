<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    public function getProducts(Request $request)
    {
        $products = Products::orderBy('created_at', 'DESC')->get();

        $response = [
            "msg" => "All Products",
            "data" => $products,
        ];

        return response()->json($response);
    }

    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|String',
            'price' => 'required|numeric',
            'available_qty' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $response = [
                'msg' => 'Add Product fail',
                'error' => $validator->errors()
            ];
            return response()->json($response, 400);
        }

        try {
            $product = Products::create([
                'name' => $request->name,
                'price' => $request->price,
                'available_qty' => $request->available_qty,
            ]);

            $response = [
                'msg' => 'product created',
                'data' => $product
            ];

            return response()->json($response);
        } catch (QueryException $e) {
            $response = [
                'msg' => 'Add Product fail',
                'error' => $e
            ];

            return response()->json($response, 500);
        }
    }
}
