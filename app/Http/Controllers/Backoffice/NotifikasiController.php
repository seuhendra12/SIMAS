<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Twilio\Rest\Client; // Import the Twilio Client class

class NotifikasiController extends Controller
{
  public function index(Request $request)
  {
    $perPage = $request->query('perPage', 10);

    $inactiveUsers = User::where('is_active', 0)->paginate($perPage);
    return view('backoffice.notifikasi.index', [
      'datas' => $inactiveUsers,
      'perPage' => $perPage
    ]);
  }

  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'is_active' => 'nullable'
    ]);

    $validatedData['is_active'] = $request->input('is_active', 0);

    $user = User::find($id);
    $user->update($validatedData);

    // Ambil nomor WhatsApp dari database
    $whatsappNumber = $user->profile->no_wa;

    // Jika akun diaktifkan dan nomor WhatsApp tersedia
    if ($validatedData['is_active'] == 1 && $whatsappNumber) {
      // Ubah nomor WhatsApp menjadi format URL yang benar
      $formattedWhatsappNumber = str_replace([' ', '-', '+'], '', $whatsappNumber);
      $whatsappUrl = 'https://wa.me/62' . $formattedWhatsappNumber;

      // Pesan yang akan ditampilkan dalam URL WhatsApp
      $whatsappMessage = urlencode("Akun SIMAS anda sudah aktif, silahkan login ke website.");

      // Redirect ke URL WhatsApp dengan pesan
      return redirect("$whatsappUrl?text=$whatsappMessage");

      // Redirect ke URL WhatsApp
    }

    return redirect('/notif')->with('success', 'Akun berhasil diaktifkan.');
  }
}
