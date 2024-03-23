<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Get authicanted user id
     */
    public function getUserId()
    {
        return auth()->id();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        if (auth()->user()->role == 'admin') {
            $this->authorize('isAdmin');
        }
        if (auth()->user()->role == 'owner') {
            $this->authorize('owner');
        }

        $data = Customer::latest()->paginate(10);

        return view('customerView.customerIndex', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('isAdmin');
        return view('customerView.customerCreate');
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

        return redirect(route('customer.create'))->with('success', 'Customer Data Successfully Created');
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
        if (auth()->user()->role == 'admin') {
            $this->authorize('isAdmin');
        }
        if (auth()->user()->role == 'owner') {
            $this->authorize('owner');
        }
        $data = Customer::find($id);

        return view('customerView.customerEdit', [
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

        return redirect(route('customer.edit', $id))->with('success', 'Customer Data Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::where('id', $id)->delete();

        return redirect(route('customer.index'))->with('success', 'Customer Data Successfully Deleted');

    }
}
