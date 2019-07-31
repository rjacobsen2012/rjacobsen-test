<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeValidator extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'                 => 'required|max:255',
            'description'           => 'required',
            'recipe_category_id'    => 'required|exists:recipe_categories,id',
            'thumbnail'             => 'max:255',
        ];
    }
}
