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
        $this->authorize('isAdmin');

        $paginate = Categories::latest()->paginate(10);

        return view('categoryView.categoryIndex', [
            'data' => $paginate
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('isAdmin');
        return view('categoryView.categoryCreate');
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

        return redirect(route('category.create'))->with('success', 'Category Success Updated');
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
        $data = Categories::find($id);

        return view('categoryView.categoryEdit', [
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

        return redirect(route('category.edit', $id))->with('success', 'Category Success Updated');
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
