<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'summary' => 'required|string|max:500', // Caption atau deskripsi
            'content' => 'required|string',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul dokumentasi diperlukan.',
            'title.max' => 'Judul maksimal 2555huruf',
            'summary.required' => 'Summary diperlukan.',
            'summary.max' => 'Summary maksimal 500 huruf',
            'content.required' => 'Content diperlukan.',
            'cover.image' => 'File yang diupload harus berupa gambar.',
            'cover.mimes' => 'cover harus berformat jpeg, png, jpg, atau gif.',
            'cover.max' => 'cover maksimal 5MB.',
        ];
    }
}
