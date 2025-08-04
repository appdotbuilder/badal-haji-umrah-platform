<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required|in:pending,accepted,in_progress,completed,cancelled',
            'agreed_price' => 'nullable|numeric|min:0',
            'proof_data' => 'nullable|array',
            'completed_at' => 'nullable|date',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'status.required' => 'Status pesanan wajib diisi.',
            'status.in' => 'Status pesanan tidak valid.',
            'agreed_price.numeric' => 'Harga yang disepakati harus berupa angka.',
            'agreed_price.min' => 'Harga yang disepakati tidak boleh kurang dari 0.',
            'completed_at.date' => 'Tanggal penyelesaian harus berupa tanggal yang valid.',
        ];
    }
}