<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * =============================
     * DISPLAY USERS + SEARCH
     * =============================
     */
    public function index(Request $request)
    {
        $query = User::query();

        // SAFE SEARCH (grouped)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()
                       ->paginate(10)
                       ->withQueryString();

        return view('users', compact('users'));
    }

    /**
     * =============================
     * STORE NEW USER
     * =============================
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users')
            ->with('success', 'User created successfully');
    }

    /**
     * =============================
     * EDIT USER
     * =============================
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * =============================
     * UPDATE USER
     * =============================
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user->update($validated);

        return redirect()->route('users')
            ->with('success', 'User updated successfully');
    }

    /**
     * =============================
     * DELETE USER
     * =============================
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return back()->with('success', 'User deleted successfully');
    }
}