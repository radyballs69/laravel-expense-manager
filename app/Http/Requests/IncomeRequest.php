<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomeRequest extends FormRequest
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
            'income_category_id' => 'required|numeric',
            'entry_date' => 'required|date',
            'entry_time' => 'required',
            'amount' => 'required|numeric',
            'description' => 'nullable|string|min:2|max:255',
        ];
    }
}
