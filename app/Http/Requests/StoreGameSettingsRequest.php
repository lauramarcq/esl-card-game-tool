<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $selectedNumberOfDecks = $this->input('selectedNumberOfDecks');

        return [
            'cardDeck1.category' => ['required'],
            'cardDeck1.list' => ['required'],
            'cardDeck2.category' => [Rule::requiredIf($selectedNumberOfDecks > 1)],
            'cardDeck2.list' => [Rule::requiredIf($selectedNumberOfDecks > 1)],
            'cardDeck3.category' => [Rule::requiredIf($selectedNumberOfDecks > 2)],
            'cardDeck3.list' => [Rule::requiredIf($selectedNumberOfDecks > 2)],
            'gameType' => ['required'],
            'level' => ['required'],
            'selectedNumberOfDecks' => ['required'],
            'cardQuantity' => ['required'],
            'showTimer' => ['boolean'],
            'showDice' => ['boolean'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'cardDeck1.category' => 'A category for deck 1 is required',
            'cardDeck1.list' => 'Select at least 1 list for deck 1',
            'selectedNumberOfDecks' => 'Select at least 1 deck',
            'cardDeck2.category' => 'A category for deck 2 is required',
            'cardDeck2.list' => 'Select at least 1 list for deck 2',
            'cardDeck3.category' => 'A category for deck 3 is required',
            'cardDeck3.list' => 'Select at least 1 list for deck 3',
        ];
    }
}
