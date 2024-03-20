<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Transactions;
use App\Models\Transactions_items;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
        $data_item = Item::latest()->paginate(12);
        return view('transactionsView.transactionsCreate', [
            'data_item' => $data_item
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $userId = $this->getUserId();
        // dd($request);

        if(!$request->has('itemid') && !$request->has('quantity')){
            return redirect(route('transactions.create'))->withErrors('Item list cannot be empty!');
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $customerCredentials = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        $customerData= Customer::create($customerCredentials);
        
        $transactionsCredentials = [
            'users_id' => $userId,
            'customer_id' => $customerData->id,
            'total_amount' => $request->totalPrice,
        ];

        $transactionData = Transactions::create($transactionsCredentials);

        foreach ($request->itemId as $key => $value) {
            $data = [
                'item_id' => $value,
                'transaction_id' => $transactionData->id,
                'quantity' => $request->quantity[$key]
            ];

            Transactions_items::create($data);
        }

        return redirect(route('items.index'))->with('success', 'berhasil kayanya');
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
