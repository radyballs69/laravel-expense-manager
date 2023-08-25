<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'income_category_id',
        'entry_date',
        'amount',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function incomeCategory(): BelongsTo
    {
        return $this->belongsTo(IncomeCategory::class, 'income_category_id', 'id');
    }

    public static function startedIncomeDate($user_id)
    {
        return static::selectRaw('YEAR(created_at) AS year')->where('user_id', $user_id)->oldest()->first();
    }

    /**
     * Combine or explode entry date & time.
     */
    protected function entryDate(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value) {
                if (request()->routeIs('incomes.edit')) 
                    return explode(' ', $value);
                if (request()->routeIs('incomes.index')) 
                    return \Carbon\Carbon::createFromDate($value)->format('M d, Y h:i A');
                return $value;
            },
            set: fn (mixed $value) => $value .' '. request('entry_time'),
        );
    }
}
