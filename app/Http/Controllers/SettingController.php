<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'app_name' => 'required',
            'admin_email' => 'required|email',
        ]);

        // Save to session (temporary storage)
        session([
            'app_name' => $request->app_name,
            'admin_email' => $request->admin_email,
        ]);

        return back()->with('success', 'Settings saved successfully!');
    }
}
