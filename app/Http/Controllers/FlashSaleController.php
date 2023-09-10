<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlashSaleController extends Controller
{
    public function getProducts(Request $request)
    {
        $flash_sale = DB::table('flash_sales')->leftJoin('products', 'flash_sales.product_id', '=', 'products.id')->select('products.*')->get();

        $response = [
            'msg' => "Flash Sale Products",
            'data' => $flash_sale
        ];

        return response()->json($response);
    }
}
