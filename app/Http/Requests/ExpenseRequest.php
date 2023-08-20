<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'expense_category_id' => 'required|numeric',
            'entry_date' => 'required|date',
            'entry_time' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required|string|min:2|max:255',
            'merchant' => 'required|string|min:2|max:255',
        ];
    }
}
