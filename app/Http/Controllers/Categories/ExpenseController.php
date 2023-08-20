<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Http\Requests\Categories\ExpenseRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('categories.expenses.index', [
            'expenseCategories' => auth()->user()->expenseCategories()->simplePaginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View 
    {
        return view('categories.expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $request->user()->expenseCategories()->create($validated);
 
        return redirect(route('expense-categories.create'))->with($this->responseCreated());
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseCategory $expenseCategory): View
    {        
        return view('categories.expenses.edit', [
            'expenseCategory' => $expenseCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, ExpenseCategory $expenseCategory): RedirectResponse
    {
        $expenseCategory->update($request->validated());

        return redirect(route('expense-categories.index'))->with($this->responseUpdated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseCategory $expenseCategory): RedirectResponse
    {        
        $expenseCategory->delete();

        return redirect()->back()->with($this->responseDeleted());
    }
}
