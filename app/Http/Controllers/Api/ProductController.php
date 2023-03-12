<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json(
            [
                'message' => 'succes',
                'data' => $products,
            ],
            200
        );
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json(
            [
                'message' => 'succes',
                'data' => $product,
            ],
            200
        );
    }

    public function store(Request $request) {
        $validator = Validator::make([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'asa.png',
            'category_id' => 1,
        ]);

        if ($validator -> fails()) {
            return response()->json(
                [
                    'message' => 'failed',
                    'data' => $validator->errors(),
                ],
                400
            );   # code...
        }

        $product = Product::create($request->all());
        return response()->json(
            [
                'message' => 'succes',
                'data' => $product,
            ],
            200
        );
    }
}
