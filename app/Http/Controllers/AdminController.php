<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Transactions_items;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {   
        $this->authorize('isAdmin');
        $data = User::paginate(10);
        return view('AdminView.adminIndex', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('isAdmin');

        $userData = User::find($id);
        // dd($userData);

        return view('AdminView.adminShow', [
            'data' => $userData
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
        // dd($request->role);

        if($request->role == 'selected'){
            return redirect(route('list-users.show', $id))->withErrors('Please Select The Available Options In Dropdowns');
        }

        $userData = User::find($id);
        $userData->role = $request->role;

        $userData->save();

        return redirect(route('list-users.show', $id))->with('success', 'Role Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userId = auth()->id();

        $userPromptDelete =  User::find($userId);
        $userData =  User::find($id);

        if($userPromptDelete->role === 'admin' && $userData->role === 'admin'){
            abort(403);
        }

        Transactions_items::where('transaction_id', $id)->delete();

        Transactions::where('users_id', $id)->delete();

        User::where('id', $id)->delete();

        return redirect(route('list-users.index'))->with('success', 'User Successfully Deleted');
    }
}
