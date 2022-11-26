<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function createProduct(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name' => 'required',
            'price' => 'required',
            'email' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'message'=>'Bad Request'
            ]);
        }
        else
        {
            $product = Product::create([
                'name' => $req->name,
                'price' => $req->price,
                'email' => $req->email,
            ]);

            return response()->json([
                'status'=>200,
                'message'=>'Product Added Successfully'
            ]);
        }
    }

    public function getProducts()
    {
        $products = Product::all();
        return response()->json([
            'status'=>200,
            'data'=>$products
        ]);
    }

    public function delProduct($id)
    {
        $delProduct = Product::find($id);
        $delProduct->delete();

      
        return response()->json([
            "status"=>200,
            "message"=>"Record Has Been Deleted"
        ]);
       
    }
}