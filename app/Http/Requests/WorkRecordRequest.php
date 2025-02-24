<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check(); // Permite solo usuarios autenticados
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'priority' => ['required', 'in:baja,media,alta'],
            'start_time' => ['required', 'date'],
            'end_time' => ['nullable', 'date', 'after_or_equal:start_time'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El título del registro es obligatorio.',
            'title.max' => 'El título no puede superar los 255 caracteres.',
            'description.max' => 'La descripción no puede superar los 1000 caracteres.',
            'priority.required' => 'Debes seleccionar una prioridad.',
            'priority.in' => 'La prioridad debe ser baja, media o alta.',
            'start_time.required' => 'Debes indicar una fecha de inicio.',
            'end_time.after_or_equal' => 'La fecha de finalización debe ser posterior o igual a la de inicio.',
        ];
    }
}
