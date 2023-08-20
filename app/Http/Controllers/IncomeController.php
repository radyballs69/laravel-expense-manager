<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\IncomeRequest;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $incomes = auth()->user()->incomes()
                        ->with('incomeCategory', fn($query) => $query->select('id', 'title'))
                        ->orderBy('id', 'desc')->simplePaginate(10);
    
        return view('incomes.index', ['incomes' => $incomes]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View 
    {
        return view('incomes.create', [
            'incomeCategories' => auth()->user()->incomeCategories()->select(['id', 'title'])->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IncomeRequest $request): RedirectResponse
    {
        $validated = $request->validated();        
        $request->user()->incomes()->create($validated);
 
        return redirect(route('incomes.create'))->with($this->responseCreated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income $income): View
    {
        return view('incomes.edit', [
            'income' => $income,
            'incomeCategories' => auth()->user()->incomeCategories()->select(['id', 'title'])->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IncomeRequest $request, Income $income): RedirectResponse
    {
        $income->update($request->validated());

        return redirect(route('incomes.index'))->with($this->responseUpdated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income): RedirectResponse
    {
        $income->delete();

        return redirect()->back()->with($this->responseDeleted());
    }
}
