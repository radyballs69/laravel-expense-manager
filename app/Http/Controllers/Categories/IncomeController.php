<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\IncomeCategory;
use App\Http\Requests\Categories\IncomeRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View 
    {
        return view('categories.income.index', [
            'incomeCategories' => auth()->user()->incomeCategories()->simplePaginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View 
    {
        return view('categories.income.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IncomeRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $request->user()->incomeCategories()->create($validated);
 
        return redirect(route('income-categories.create'))->with($this->responseCreated());
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomeCategory $IncomeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomeCategory $IncomeCategory): View
    {        
        return view('categories.income.edit', [
            'incomeCategory' => $IncomeCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IncomeRequest $request, IncomeCategory $IncomeCategory): RedirectResponse
    {
        $IncomeCategory->update($request->validated());

        return redirect(route('income-categories.index'))->with($this->responseUpdated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomeCategory $IncomeCategory): RedirectResponse
    {        
        $IncomeCategory->delete();

        return redirect(route('income-categories.index'))->with($this->responseDeleted());
    }
}
