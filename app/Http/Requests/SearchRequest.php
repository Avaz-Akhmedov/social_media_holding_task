<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'entity' => ['required','in:recipes,products,posts,users'],
            'search_query' =>['required','string','max:255']
        ];
    }
}
