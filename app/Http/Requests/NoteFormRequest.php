<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method = $this->method();

        if ($method == 'PATCH') {
            return [
                'title' => ['sometimes', 'required', 'string'],
                'text' => ['sometimes', 'required', 'string'],
                'idYTVideo' => ['sometimes', 'required', 'string'],
            ];
        } else {
            return [
                'title' => 'required|string',
                'text' => 'required|string',
                'idYTVideo' => 'required|string',
            ];
        }
    }
}
