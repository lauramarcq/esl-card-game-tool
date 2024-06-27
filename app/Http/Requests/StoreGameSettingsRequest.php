<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameSettingsRequest extends FormRequest
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
            'cardDeck1' => ['required'],
            'cardDeck2' => ['required'],
            'cardDeck3' => ['required'],
            'gameType' => ['required'],
            'level' => ['required'],
            'selectedNumberOfDecks' => ['required'],
        ];
    }
}
