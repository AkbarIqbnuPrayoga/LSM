<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('dashboardUserss.dashboardUser', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('dashboardUser')->with('success', 'Password changed successfully');
    }
    public function updateName(Request $request)
    {
        $request->validate([
            'new_name' => 'required|string|max:255'
        ]);

        $user = auth()->user();
        $user->name = $request->new_name;
        $user->save();

        return back()->with('success', 'Nama berhasil diperbarui.');
    }
}
