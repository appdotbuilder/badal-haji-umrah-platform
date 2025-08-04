<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceProviderRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'certifications' => 'nullable|array',
            'certifications.*' => 'string|max:255',
            'experience' => 'nullable|string',
            'social_media_links' => 'nullable|array',
            'social_media_links.*.platform' => 'required_with:social_media_links|string|max:50',
            'social_media_links.*.url' => 'required_with:social_media_links|url|max:255',
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
            'name.required' => 'Nama penyedia layanan wajib diisi.',
            'description.required' => 'Deskripsi layanan wajib diisi.',
            'social_media_links.*.platform.required_with' => 'Platform media sosial wajib diisi.',
            'social_media_links.*.url.required_with' => 'URL media sosial wajib diisi.',
            'social_media_links.*.url.url' => 'URL media sosial harus berupa URL yang valid.',
        ];
    }
}