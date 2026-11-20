<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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


        return view('products.index', compact('title','products','total','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

        $request->validate([
        'nama' => 'required',
        'stok' => 'required|integer|min:0',
        'harga' => 'required|numeric|min:0',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ],[
            'nama.required' => 'Nama produk wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
            'gambar.required' => 'Gambar wajib diisi.',
            'gambar.image' => 'File yang diupload harus berupa gambar.',
            'gambar.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg, gif.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);


        Product::create([
            'nama'  => $request->nama,
            'stok'  => $request->stok,
            'harga' => $request->harga,
            'gambar' => $request->file('gambar')->store('products', 'public'),
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');

            } catch (\Exception $e) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Produk gagal disimpan');

            }
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
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
        //return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
        'nama'  => 'required|max:255',
        'stok'  => 'required|integer|min:0',
        'harga' => 'required|numeric|min:0',
    ]);

    $product->update([
        'nama'  => $request->nama,
        'stok'  => $request->stok,
        'harga' => $request->harga,
    ]);

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }

        $path = $request->file('gambar')->store('products', 'public');
        $product->update(['gambar' => $path]);

    }

    return redirect()
        ->route('products.index')
        ->with('success', 'Produk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //  dd($product);
        //  $product = Product::findOrFail($id);
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
            }

        $product->delete();



        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus');
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
