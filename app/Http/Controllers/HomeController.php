<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produk = Product::with('processings')
            ->where('is_active', true)
            ->orderBy('name', 'asc')
            ->limit(7)
            ->get();

        return view('home.home', [
            "title"  => "Home",
            "produk" => $produk,
        ]);
    }
}
