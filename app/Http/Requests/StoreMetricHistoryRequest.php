<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMetricHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'url' => 'required|string',
            'strategy' => 'required|string|in:desktop,mobile',
            'metrics' => 'required|array',
            'metrics.performance.score' => 'required|numeric',
            'metrics.accessibility.score' => 'required|numeric',
            'metrics.best-practices.score' => 'required|numeric',
            'metrics.seo.score' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'url.required' => 'La URL es obligatoria.',
            'url.string' => 'La URL debe ser una cadena de texto válida.',
            'strategy.required' => 'La estrategia es obligatoria.',
            'strategy.string' => 'La estrategia debe ser una cadena de texto.',
            'strategy.in' => 'La estrategia debe ser "desktop" o "mobile".',
            'metrics.required' => 'Las métricas son obligatorias.',
            'metrics.array' => 'Las métricas deben ser un array.',
            'metrics.performance.score.required' => 'El puntaje de performance es obligatorio.',
            'metrics.performance.score.numeric' => 'El puntaje de performance debe ser un número.',
            'metrics.accessibility.score.required' => 'El puntaje de accessibility es obligatorio.',
            'metrics.accessibility.score.numeric' => 'El puntaje de accessibility debe ser un número.',
            'metrics.best-practices.score.required' => 'El puntaje de best practices es obligatorio.',
            'metrics.best-practices.score.numeric' => 'El puntaje de best practices debe ser un número.',
            'metrics.seo.score.required' => 'El puntaje de SEO es obligatorio.',
            'metrics.seo.score.numeric' => 'El puntaje de SEO debe ser un número.',
        ];
    }
}
