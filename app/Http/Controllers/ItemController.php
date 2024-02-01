<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('itemView.itemIndex',[
            'isLogin' => false,
            'active' => 'item'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('itemView.itemCreate',[
            'isLogin' => false,
            'active' => 'item'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);    
        $validatedRequest = $request->validate([
            'item-name' => 'required|string',
            'item-price' => 'required|numeric',
            'item-stock' => 'required|numeric',
            'item-category' => 'required',
            'item-cost-price' => 'required|numeric',
        ]);

        return redirect(route('items.create'))->with('success', 'berhasil kayanya');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
