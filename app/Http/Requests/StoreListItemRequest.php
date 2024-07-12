<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreListItemRequest extends FormRequest
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
            'item_value' => ['required', 'string', 'min:2', Rule::unique('list_items')->where(function ($query) {
                return $query->where('game_list_id', $this->input('game_list_id'));
            }),],
            'game_list_id' => ['required', 'integer', 'exists:game_lists,id'],
        ];
    }
}
