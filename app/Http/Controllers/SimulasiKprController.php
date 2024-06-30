<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulasikprController extends Controller
{
    public function index()
    {
        return view('simulasikpr');
    }

    public function calculate(Request $request)
{
    $request->validate([
        'harga_rumah' => 'required|numeric|min:1',
        'uang_muka' => 'required|numeric|min:0',
        'suku_bunga' => 'required|numeric|min:0',
        'tenor' => 'required|numeric|min:1'
    ]);

    $harga_rumah = $request->input('harga_rumah');
    $uang_muka = $request->input('uang_muka');
    $suku_bunga = $request->input('suku_bunga');
    $tenor = $request->input('tenor');

    $jumlah_pinjaman = $harga_rumah - $uang_muka;
    $bunga_per_bulan = $suku_bunga / 100 / 12;
    $jumlah_cicilan = $tenor * 12;

    $cicilan_per_bulan = $jumlah_pinjaman * ($bunga_per_bulan * pow(1 + $bunga_per_bulan, $jumlah_cicilan)) / (pow(1 + $bunga_per_bulan, $jumlah_cicilan) - 1);
    
    $cicilan_per_tahun = $cicilan_per_bulan * 12;

    return view('hasilkpr', compact('cicilan_per_bulan', 'cicilan_per_tahun', 'jumlah_pinjaman', 'tenor'));
    }
}