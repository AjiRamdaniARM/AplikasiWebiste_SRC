<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->isMethod('post')) {
            $path = 'required';
        } else {
            $path = 'nullable';
        }

        return [
            'category' => ['required'],
            'name' => ['required', 'string', 'min:2'],
            'description' => ['required', 'string', 'min:2'],
            'juknis_lomba' => ['required', 'string'],
            'point' => ['required', 'numeric'],
            'duration' => ['required', 'date_format:H:i'],
            'session' => ['required', 'numeric'],
            'date_race' => ['required', 'date'],
            'price' => ['required', 'numeric'],
            'deadline_reg' => ['required', 'date'],
            'team' => ['nullable'],
            'max_people' => ['nullable', 'integer'],
            'document' => ['nullable'],
            'path' => [$path, 'string'],
        ];
    }
}
