<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentationRequest extends FormRequest
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
            'caption' => 'required|string', // Caption atau deskripsi
            'youtube' => 'required|url', 
            
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul dokumentasi diperlukan.',
            'caption.required' => 'Caption diperlukan.',
            'youtube.required' => 'Url Youtube diperlukan.',
            'youtube.url' => 'kolom youtube diisi dengan link url youtube',
        ];
    }
}
