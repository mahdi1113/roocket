<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(12);
        return view('home.product.index',compact('products'));
    }

    public function show(Product $product)
    {
        return view('home.product.show',compact('product'));
    }

    public function comment(Request $request,Product $product)
    {
        $data = $request->validate([
            'comment' => 'required',
        ]);
        $product->comments()->create([
            'comment' => $request->comment,
            'parent_id' => $request->parent_id,
            'user_id' => auth()->user()->id,
        ]);
        $msg = 'کامنت ثبت شد منتظر تایید مدیر';
        return redirect()->back()->with('success',$msg);
    }
}
