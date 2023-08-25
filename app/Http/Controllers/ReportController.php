<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\View\View;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $from = Carbon::parse(sprintf(
            '%s-%s-01',
            request()->query('year', Carbon::now()->year),
            request()->query('month', Carbon::now()->month)
        ));
        $to      = clone $from;
        $to->day = $to->daysInMonth;
        
        $startedDate = Expense::startedExpenseDate(auth()->user()->id)->created_at;
        
        $expenses = Expense::selectRaw('expense_category_id, SUM(amount) AS amount')
                        ->with('expenseCategory', fn($query) => $query->select('id', 'title'))
                        ->where('user_id', auth()->user()->id)
                        ->whereBetween('entry_date', [$from, $to])
                        ->groupBy('expense_category_id')->get();

        $incomes = Income::selectRaw('income_category_id, SUM(amount) AS amount')
                        ->with('incomeCategory', fn($query) => $query->select('id', 'title'))
                        ->where('user_id', auth()->user()->id)
                        ->whereBetween('entry_date', [$from, $to])
                        ->groupBy('income_category_id')->get();

        $totalExpenses = $expenses->sum('amount') ?? 0;
        $totalIncomes = $incomes->sum('amount') ?? 0;

        return view('reports.index', compact(
            'expenses',
            'incomes',
            'totalExpenses',
            'totalIncomes',
            'startedDate',
        ));
    }
}
