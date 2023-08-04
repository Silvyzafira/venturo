<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VenturoController extends Controller
{
    public function fetchData(Request $request)
    {
        if ($request->has('tahun')) {
            $tahun = $request->input('tahun');
            $menu = json_decode(file_get_contents("http://tes-web.landa.id/intermediate/menu"));
            $transaksi = json_decode(file_get_contents("http://tes-web.landa.id/intermediate/transaksi?tahun=".$tahun));
            return view('venturo', compact('menu', 'transaksi','tahun'));
        } else {
            return view('venturo');
        }
    }
    //
    // public function index(Request $request)
    // {
    //     $tahun = $request->tahun; 
    //     $transaksiData = $this->getTransaksiByTahun($tahun);
    //     $menuData = $this->getMenu();
    //     $foods = $menuData['foods'];
    //     $drinks = $menuData['drinks'];
        
    //     return view('welcome', compact('foods', 'drinks', 'transaksiData'));
    // }
    public function getMenuFromAPI()
    {
        $url = 'https://tes-web.landa.id/intermediate/menu';
        $response = Http::get($url);
        if ($response->ok()) {
            $menuData = $response->json();
            return response()->json($menuData);
        } else {
            return response()->json(['message' => 'Failed to fetch menu data from API'], $response->status());
        }
    }

    public function getTransaksiByTahun(Request $request)
    {
        $tahun = $request->input('tahun');

        if (!$tahun) {
            return response()->json(['message' => 'Invalid input. Tahun is required.'], 400);
        }

        $url = 'http://tes-web.landa.id/intermediate/transaksi?tahun=' . urlencode($tahun);
        $response = Http::get($url);

        if ($response->ok()) {
            $transaksiData = $response->json();
            return $transaksiData;
            // return response()->json($transaksiData);
        } else {
            return response()->json(['message' => 'Failed to fetch transaction data from API'], $response->status());
        }
    }

    public function getMenu()
    {
        $url = 'http://tes-web.landa.id/intermediate/menu';
        $response = Http::get($url);

        if ($response->ok()) {
            $menuData = $response->json();

            // Membagi data menu berdasarkan kategori makanan dan minuman
            $foods = [];
            $drinks = [];

            foreach ($menuData as $menu) {
                if ($menu['kategori'] === 'makanan') {
                    $foods[] = $menu;
                } elseif ($menu['kategori'] === 'minuman') {
                    $drinks[] = $menu;
                }
            }
            // return compact('foods', 'drinks'); 
            return view('welcome', compact('foods', 'drinks'));
        } else {
            return response()->json(['message' => 'Failed to fetch menu data from API'], $response->status());
        }
    }

}
