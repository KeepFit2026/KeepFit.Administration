<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnboardingRequest extends FormRequest
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
            'school'         => ['required', 'string', 'max:255'],
            'grade'          => ['required', 'string', 'max:50'],
            'sports_profile' => ['required', 'string', 'in:eps_only,unss,club,section'],
            'primary_goal'   => ['required', 'string', 'in:exam,competition,decompress,discovery'],
        ];
    }
}
