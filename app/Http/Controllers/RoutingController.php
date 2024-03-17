<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RoutingController extends Controller
{
    public function getUserId()
    {
        return auth()->id();
    }


    public function index ()
    {
        $userId = $this->getUserId();
        $itemData = Item::where('users_id', $userId)->orderBy('created_at', 'desc')->first();
        $categoryData = Categories::where('users_id', $userId)->orderBy('created_at', 'desc')->first();
        $customerData = Customer::where('users_id', $userId)->orderBy('created_at', 'desc')->first();
        return view('dashboard', [
            'active' => 'dashboard',
            'data' => array('itemData' => $itemData, 'categoryData' => $categoryData, 'customerData' => $customerData)
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
