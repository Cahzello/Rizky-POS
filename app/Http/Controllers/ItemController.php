<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        $this->authorize('isAdmin');
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
        $this->authorize('isAdmin');
        $user_id = $this->getUserId();

        $data = Categories::where('users_id', $user_id)->get();
        // dd($data);
        return view('itemView.itemCreate',[
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('item_image')){
            $path = $request->file('item_image')->store('ItemImage');
        } else {
            $path = null;
        }
    
        $validatedRequest = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock_level' => 'required|numeric',
            'categories_id' => 'required',
            'cost_price' => 'required|numeric',
            'item_image' => 'image'
        ]);

        $validatedRequest['item_image'] = $path;
        $validatedRequest['users_id'] = $this->getUserId();

        Item::create($validatedRequest);

        return redirect(route('items.create'))->with('success', 'Item Successfully Added');
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
        $this->authorize('isAdmin');    
        $user_id = $this->getUserId();

        $data = Item::find($id);
        $categories = Categories::where('users_id', $user_id)->get();
        return view('itemView.itemEdit',[
            'data' => $data,
            'categories' => $categories,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        if($request->hasFile('item_image')){
            $path = $request->file('item_image')->store('ItemImage');
        } else {
            $path = null;
        }
    
        $validatedRequest = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock_level' => 'required|numeric',
            'categories_id' => 'required',
            'cost_price' => 'required|numeric',
            'item_image' => 'image',
        ]);

        $validatedRequest['item_image'] = $path;

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
