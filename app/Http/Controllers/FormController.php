<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
public function showForm()
{
return view('form');
}

public function submitForm(Request $request)
{
$validated = $request->validate([
'nama' => 'required|string|max:100',
'email' => 'required|email',
'pesan' => 'required|string|max:500',
]);

// Misalnya, simpan ke database atau tampilkan kembali
return back()->with('success', 'Form berhasil dikirim!');
}
}