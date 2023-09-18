<?php

namespace App\Http\Requests;

use App\Enums\TasksPriorityEnum;
use App\Rules\ParentTaskIdRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'priority' => 'required|in:' . implode(',', array_column(TasksPriorityEnum::cases(), 'value')),
            'parent_task_id' => ['nullable', 'integer', 'exists:tasks,id', new ParentTaskIdRule],
        ];
    }
}
