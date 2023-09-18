<?php

namespace App\Rules;

use Closure;
use App\Models\Task;
use Illuminate\Contracts\Validation\ValidationRule;

class ParentTaskIdRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (auth()->id() !== Task::find($value)?->user_id) {
            $fail('Parent taks not found.');
        }
    }
}
