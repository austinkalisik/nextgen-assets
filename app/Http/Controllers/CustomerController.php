<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('customers', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        Customer::create($validated);

        return back()->with('success', 'Customer added');
    }

    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();

        return back()->with('success', 'Customer deleted');
    }
}
