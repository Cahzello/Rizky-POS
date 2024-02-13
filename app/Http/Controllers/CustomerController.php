<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::get()->all();

        return view('customerView.customerIndex', [
            'isLogin' => false,
            'active' => 'users',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customerView.customerCreate', [
            'isLogin' => false,
            'active' => 'users'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        Customer::create($validatedRequest);

        return redirect(route('customer.create'))->with('success', 'Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Customer::find($id);

        return view('customerView.customerEdit', [
            'isLogin' => false,
            'active' => 'users',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedRequest = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        Customer::where('id', $id)->update($validatedRequest);

        return redirect(route('customer.edit', $id))->with('success', 'Success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::where('id', $id)->delete();

        return redirect(route('customer.index'))->with('success', 'Success');

    }
}
