<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

        $paginate = Categories::where('users_id', $user_id)->paginate(10);

        return view('categoryView.categoryIndex', [
            'isLogin' => false,
            'data' => $paginate
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoryView.categoryCreate', [
            'isLogin' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'name' => 'required|string',
        ]);

        Categories::create($validatedRequest);

        return redirect(route('category.create'))->with('success', 'Success');
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
        $data = Categories::find($id);

        return view('categoryView.categoryEdit', [
            'isLogin' => false,
            'active' => 'category',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedRequest = $request->validate([
            'name' => 'required|string',
        ]);

        Categories::where('id', $id)->update($validatedRequest);

        return redirect(route('category.edit', $id))->with('success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categories::where('id', $id)->delete();

        return redirect(route('category.index'))->with('success', 'Success: Data successfully deleted.');
    }
}
