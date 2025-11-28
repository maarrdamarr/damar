<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 6 barang lelang terbaru yang statusnya 'open'
        $items = Item::where('status', 'open')->latest()->take(6)->get();

        // Ambil 3 berita terbaru
        $news = News::latest()->take(3)->get();

        return view('welcome', compact('items', 'news'));
    }
}