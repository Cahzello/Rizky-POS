<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $nama_category = [];
        $data = Item::get()->all();
        foreach ($data as $key => $value) {
            $nama_category[$key] = $value->categories->name;
        }
        return view('itemView.itemIndex',[
            'isLogin' => false,
            'active' => 'item',
            'data' => $data,
            'category' => $nama_category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $data = Categories::get()->all();
        // dd($data);
        return view('itemView.itemCreate',[
            'isLogin' => false,
            'active' => 'item',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);    
        $validatedRequest = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock_level' => 'required|numeric',
            'categories_id' => 'required',
            'cost_price' => 'required|numeric',
        ]);

        Item::create($validatedRequest);

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
