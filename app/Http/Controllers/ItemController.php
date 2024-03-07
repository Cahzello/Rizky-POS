<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
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
        $user_id = $this->getUserId();

        $filtered_data = Item::with('categories')->where('users_id', $user_id)->paginate(10);

        //it seems error but its not, just intelephense being intelephense. see https://laravel.com/docs/10.x/collections#method-pluck
        $nama_category = $filtered_data->pluck('categories.name');

        // dd($filtered_data);
        return view('itemView.itemIndex',[
            'isLogin' => false,
            'data' => $filtered_data,
            'category' => $nama_category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $user_id = $this->getUserId();

        $data = Categories::where('users_id', $user_id)->get();
        // dd($data);
        return view('itemView.itemCreate',[
            'isLogin' => false,
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
        $user_id = $this->getUserId();

        $data = Item::find($id);
        $categories = Categories::where('users_id', $user_id);
        return view('itemView.itemEdit',[
            'isLogin' => false,
            'active' => 'item',
            'data' => $data,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedRequest = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock_level' => 'required|numeric',
            'categories_id' => 'required',
            'cost_price' => 'required|numeric',
        ]);

        Item::where('id', $id)->update($validatedRequest);

        return redirect(route('items.index', '#data_' . $id))->with('success', 'Data Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Item::where('id', $id)->delete();

        return redirect(route('items.index'))->with('success', 'Data Successfully Deleted');
    }

}
