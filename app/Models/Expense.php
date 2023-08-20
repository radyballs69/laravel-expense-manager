<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'expense_category_id',
        'entry_date',
        'amount',
        'description',
        'merchant',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function expenseCategory(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id', 'id');
    }

    /**
     * Combine or explode entry date & time.
     */
    protected function entryDate(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value) {
                if (request()->routeIs('expenses.edit')) 
                    return explode(' ', $value);
                if (request()->routeIs('expenses.index')) 
                    return \Carbon\Carbon::createFromDate($value)->format('M d, Y h:i A');
                return $value;
            },
            set: fn (mixed $value) => $value .' '. request('entry_time'),
        );
    }
}
