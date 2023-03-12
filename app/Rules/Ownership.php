<?php

namespace App\Rules;

use Illuminate\Validation\Rule;

class Ownership extends Rule
{
    protected mixed $model;

    /**
     * @param mixed $model
     */
    public function __construct(mixed $model)
    {
        $this->model = $model;
    }

    /**
     * @param $attribute
     * @param $object
     * @return bool
     */
    public function passes($attribute, $object): bool
    {
        return $object->user_id === auth()->id();
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'This object does not belong to you.';
    }
}
