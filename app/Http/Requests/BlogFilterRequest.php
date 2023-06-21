<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class BlogFilterRequest extends FormRequest
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
            'title' => ['min:4'],
            'slug' => ['regex:/^[a-z0-9\-]+$/']
        ];
    }

    // function protegé preparé avant la validation
    protected function prepareForValidation()
    {
        //dans le cas je n'est pas un slug, j'utilise la méthode pour genéré un slug à partir du titre 
        $this->merge([
            'slug' => $this->input('slug') ?: Str::slug($this->input('title'))
        ]);
    }
}
