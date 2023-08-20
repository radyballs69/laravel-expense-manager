<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\ExpenseRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $expenses = auth()->user()->expenses()
                        ->with('expenseCategory', fn($query) => $query->select('id', 'title'))
                        ->orderBy('id', 'desc')->simplePaginate(10);
    
        return view('expenses.index', ['expenses' => $expenses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View 
    {
        return view('expenses.create', [
            'expenseCategories' => auth()->user()->expenseCategories()->select(['id', 'title'])->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request): RedirectResponse
    {
        $validated = $request->validated();        
        $request->user()->expenses()->create($validated);
 
        return redirect(route('expenses.create'))->with($this->responseCreated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense): View
    {
        return view('expenses.edit', [
            'expense' => $expense,
            'expenseCategories' => auth()->user()->expenseCategories()->select(['id', 'title'])->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, Expense $expense): RedirectResponse
    {
        $expense->update($request->validated());

        return redirect(route('expenses.index'))->with($this->responseUpdated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense): RedirectResponse
    {        
        $expense->delete();

        return redirect()->back()->with($this->responseDeleted());
    }
}
