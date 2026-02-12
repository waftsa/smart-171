<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBulletinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title' => 'required|string|max:255', // Judul dokumentasi
            'publisher' => 'required|string|max:500', // Caption atau deskripsi
            'file' => 'required|file|mimes:pdf|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul dokumentasi diperlukan.',
            'title.max' => 'Judul maksimal 2555huruf',
            'publisher.required' => 'publisher diperlukan.',
            'publisher.max' => 'publisher maksimal 500 huruf',
            'file.required' => 'File diperlukan.',
            'file.file' => 'File yang diupload harus berupa file.',
            'file.mimes' => 'File harus berformat PDF.',
            'file.max' => 'File maksimal 5MB.',
        ];
    }
}
