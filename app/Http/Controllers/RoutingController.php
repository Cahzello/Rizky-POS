<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Transactions;

class RoutingController extends Controller
{
    public function getUserId()
    {
        return auth()->id();
    }


    public function index ()
    {
        $itemData = Item::latest()->first();
        $categoryData = Categories::latest()->first();
        $customerData = Customer::latest()->first();
        $transactionData = Transactions::with('customers')->where('users_id', auth()->id())->latest()->first();
        $cusData = $transactionData->customers;

        return view('dashboard', [
            'active' => 'dashboard',
            'data' => array(
                'itemData' => $itemData,
                'categoryData' => $categoryData, 
                'customerData' => $customerData,
                'transactionData' => $transactionData,
                'customerData' => $cusData,
                )
        ]);

    }

    public function login ()
    {
        return view('login', [
        ]);
    }

    public function register ()
    {
        return view('register', [
        ]);
    }

}
