<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport; // <-- Ini penting, biar ga error saat export

class UsersController extends Controller
{
    // Menampilkan semua user dan form tambah user
    public function index()
    {
        $users = User::all(); // Ambil semua user
        return view('users.index', compact('users'));
    }

    // Menyimpan data user dari form
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Simpan user ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
        ]);

        // Balik ke dashboard dengan pesan sukses
        return redirect('/')->with('success', 'User berhasil ditambahkan!');
    }

    // Export data user ke Excel
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
