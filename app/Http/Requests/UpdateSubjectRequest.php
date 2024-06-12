<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject' => 'required|string',
            'is_plural' => 'required|boolean',
            'begins_with_article_a' => 'required|boolean',
            'begins_with_article_an' => 'required|boolean',
            'begins_with_article_the' => 'required|boolean',
            'is_people' => 'required|boolean',
            'is_animal' => 'required|boolean',
            'is_place' => 'required|boolean',
            'is_thing' => 'required|boolean',
        ];
    }
}
