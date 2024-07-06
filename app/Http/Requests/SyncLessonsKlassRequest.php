<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SyncLessonsKlassRequest extends FormRequest
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
            'lessons' => 'required|array',
            'lessons.*.klass_id' => 'required|exists:klasses,id',
            'lessons.*.lesson_id' => 'required|exists:lessons,id',
            'lessons.*.order' => 'required|integer',
        ];
    }
}
