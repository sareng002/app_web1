<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pest\Support\View;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'Daftar Produk';
        //$products = Product::all();
        //$products = Product::paginate(10);
        $search = request('search');

        $products = Product::when(
            $search,
            function ($query) use ($search) {
                $query->where(
                    'nama',
                    'like',
                    "%{$search}%"
                );
            }
        )
        ->paginate(10)
        ->withQueryString();


        $total = Product::count();


        return view('produk', compact('title','products','total','search'));
    }

    public function ajaxSearch()
        {
            $search = request('search');

            if (!$search) {
                    return response()->json([
                        'reload' => true
                    ]);
                }

            $products = Product::where(
                'nama',
                'like',
                "%{$search}%"
            )->get();

            return response()->json($products);
        }
}
