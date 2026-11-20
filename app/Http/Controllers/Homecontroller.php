<?php

namespace App\Http\Controllers;

use App\Models\Product as ModelsProduct;
use Illuminate\Http\Request;
use Model\product;

class Homecontroller extends Controller
{
   public function tampilgambar()
    {
        // Mengambil hanya nilai kolom 'gambar' sebagai Collection
       // $gambar = ModelsProduct::all()->pluck('gambar');

        //$gambar = ModelsProduct::whereNotNull('gambar')->pluck('gambar');
        $semuaGambar = ModelsProduct::whereNotNull('gambar')
            ->pluck('gambar')
            ->filter()
            ->values();

        $gambarPertama = $semuaGambar->first();

        return view('home', compact('semuaGambar', 'gambarPertama'));

       // return view('home', compact('gambar'));

    }
}
