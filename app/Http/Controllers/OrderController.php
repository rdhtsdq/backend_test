<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function Order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'qty' => 'required|min:1|max:30'
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => 'Failed To Make Order', 'error' => $validator->errors()], 400);
        }

        return DB::transaction(function () use ($request) {
            $data = DB::select("SELECT * FROM products where id = ? FOR UPDATE", [$request->product_id]);
            $updateQty = $data[0]->available_qty - $request->qty;

            if ($updateQty >= 0) {
                try {
                    DB::table('orders')->insert([
                        'product_id' => $request->product_id,
                        'qty' => $request->qty
                    ]);

                    DB::table('products')->where('id', $request->product_id)->update([
                        'available_qty' => $updateQty
                    ]);

                    return response()->json(['msg' => 'Order Created']);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['msg' => 'Order failed', 'error' => $e->getMessage()], 500);
                }
            } else {
                return response()->json(['msg' => 'Unable to make order: product is out of stock'], 400);
            }
        });
    }
}
