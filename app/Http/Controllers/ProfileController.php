<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Menampilkan halaman edit profil
    public function index()
    {
        // Ambil data pengguna yang sedang login
        // $user = Auth::user();

        // // Pastikan pengguna sudah terautentikasi
        // if (!$user) {
        //     return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        // }

        return view('profile.profile');
    }

    // Memperbarui data profil pengguna
    public function update(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::id()),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();
        return redirect()->route('profile')->with('success','Berhasil memperbarui data!');
        
        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika password diisi, maka ubah password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan data pengguna
        $user->save();

        $request->session()->flash('success', 'Profile updated successfully!');
    return redirect()->route('profile.update');
    }

    // Fungsi untuk logout pengguna
    public function logout(Request $request)
    {
        // Melakukan logout pengguna
        Auth::logout();

        // Menghapus sesi pengguna
        $request->session()->invalidate();

        // Mengenerate ulang token CSRF
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
