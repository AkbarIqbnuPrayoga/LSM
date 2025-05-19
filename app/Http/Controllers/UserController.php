<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Tampilkan halaman kelola user
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.kelola_user', compact('users'));
    }

    // Form edit email user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user_email', compact('user'));
    }

    // Update email user
    public function updateEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Email user berhasil diperbarui');
    }

    // Form ganti password user
    public function updatePasswordForm($id)
    {
        $user = User::findOrFail($id);
        return view('admin.update_user_password', compact('user'));
    }

    // Update password user
    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password user berhasil diperbarui');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
