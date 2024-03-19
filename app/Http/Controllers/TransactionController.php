<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
        return view('transactionsView.transactionsIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = $this->getUserId();

        $data_item = Item::where('users_id', $user_id)->paginate(12);
        return view('transactionsView.transactionsCreate', [
            'data_item' => $data_item
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'item-name' => 'required|string',
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
