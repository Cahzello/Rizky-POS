<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Transactions;
use App\Models\Transactions_items;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\CssSelector\Node\FunctionNode;

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
        $transactionsData = Transactions::where('users_id', auth()->id())->latest()->paginate(10);
        $userName = $transactionsData->pluck('users.username');
        $customerName = $transactionsData->pluck('customers.name');
        return view('transactionsView.transactionsIndex', [
            'data' => $transactionsData,
            'userName' => $userName,
            'customerName' => $customerName,
        ]);
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

        if (!$request->has('itemid') && !$request->has('quantity')) {
            return redirect(route('transactions.create'))->withErrors('Item list cannot be empty!');
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
        
        foreach ($request->itemId as $key => $value) {
            $item = Item::find($value);
            $newStockLevel = $item->stock_level - $request->quantity[$key];

            // Check if the new stock level is negative
            if ($newStockLevel < 0) {
                return redirect(route('transactions.create'))->withErrors('Insufficient stock for item');
            }
        }

        

        $customerCredentials = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        $customerData = Customer::create($customerCredentials);

        $transactionsCredentials = [
            'users_id' => $userId,
            'customers_id' => $customerData->id,
            'total_amount' => $request->totalPrice,
        ];

        $transactionData = Transactions::create($transactionsCredentials);

        foreach ($request->itemId as $key => $value) {
            $data = [
                'items_id' => $value,
                'transaction_id' => $transactionData->id,
                'quantity' => $request->quantity[$key]
            ];

            // Update the item's stock level
            $item->stock_level = $newStockLevel;
            $item->save(); // Save the updated stock level to the database

            // Optionally, you can also create a transaction item here if needed
            Transactions_items::create($data);


            // Transactions_items::create($data);

        }

        return redirect(route('transactions.index'))->with('success', 'Transactions Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the transaction and related data
        $transaksi = Transactions::with(['users', 'customers'])->find($id);

        // Extract the cashier and customer names directly from the transaction
        $cashierName = $transaksi->users->username;
        $customerName = $transaksi->customers->name;

        // Fetch all transaction items associated with the transaction ID
        $transactionItems = Transactions_items::with('items')->where('transaction_id', $id)->get();

        // Prepare the final array with both transaction item data and item details
        $allItemData = $transactionItems->map(function ($transactionItem) {
            return $transactionItem->items;
        })->all();

        $categories = array_map(function ($item) {
            return $item->categories->name;
        }, $allItemData);

        // dd($transactionItems);

        return view('transactionsView.transactionsShow', [
            'transactionData' => $transaksi,
            'transactionItem' => $transactionItems,
            'itemData' => $allItemData,
            'category' => $categories,
            'cashierName' => $cashierName,
            'customerName' => $customerName,
        ]);
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
