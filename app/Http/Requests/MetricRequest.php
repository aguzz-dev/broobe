<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetricRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'url' => 'required|string',
            'pwa' => 'sometimes|boolean',
            'seo' => 'sometimes|boolean',
            'performance' => 'sometimes|boolean',
            'best_practices' => 'sometimes|boolean',
            'accessibility' => 'sometimes|boolean',
            'strategy' => 'required|in:mobile,desktop',
            'pwa' => 'required_without_all:seo,performance,best_practices,accessibility|boolean',
            'seo' => 'required_without_all:pwa,performance,best_practices,accessibility|boolean',
            'performance' => 'required_without_all:pwa,seo,best_practices,accessibility|boolean',
            'best_practices' => 'required_without_all:pwa,seo,performance,accessibility|boolean',
            'accessibility' => 'required_without_all:pwa,seo,performance,best_practices|boolean',
        ];
    }

    public function messages()
    {
        return [
            'url.required' => 'La URL es obligatoria.',
            'url.url' => 'La URL debe ser válida.',
            'strategy.required' => 'La estrategia es obligatoria.',
            'strategy.in' => 'La estrategia debe ser "mobile" o "desktop".',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'pwa' => filter_var($this->input('pwa'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'seo' => filter_var($this->input('seo'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'performance' => filter_var($this->input('performance'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'best_practices' => filter_var($this->input('best_practices'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'accessibility' => filter_var($this->input('accessibility'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

}
