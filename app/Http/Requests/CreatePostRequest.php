<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','min:7'],
            //                                          regle pour un champs unique sur la table post et ignorer la route avec le parametre post(update) 
            'slug' => ['min:5', 'regex:/^[0-9a-z\-]+$/',Rule::unique('posts')->ignore($this->route()->parameter('post'))],
            'content' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' =>['required','array','exists:post,id']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->input('slug') ?: Str::slug($this->input('title'))
        ]);
    }
}
