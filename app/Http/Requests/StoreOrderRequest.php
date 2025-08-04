<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'service_provider_id' => 'required|exists:service_providers,id',
            'service_type' => 'required|in:badal_haji,badal_umrah',
            'description' => 'required|string',
            'proposed_price' => 'required|numeric|min:0',
            'proof_type' => 'required|in:video_recording,live_video,location_map,photo',
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
            'service_provider_id.required' => 'Penyedia layanan wajib dipilih.',
            'service_provider_id.exists' => 'Penyedia layanan yang dipilih tidak valid.',
            'service_type.required' => 'Jenis layanan wajib dipilih.',
            'service_type.in' => 'Jenis layanan harus Badal Haji atau Badal Umrah.',
            'description.required' => 'Deskripsi pesanan wajib diisi.',
            'proposed_price.required' => 'Harga penawaran wajib diisi.',
            'proposed_price.numeric' => 'Harga penawaran harus berupa angka.',
            'proposed_price.min' => 'Harga penawaran tidak boleh kurang dari 0.',
            'proof_type.required' => 'Jenis bukti penyelesaian wajib dipilih.',
            'proof_type.in' => 'Jenis bukti penyelesaian tidak valid.',
        ];
    }
}