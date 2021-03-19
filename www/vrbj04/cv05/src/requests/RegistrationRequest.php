<?php


namespace cv05\src\requests;


use cv05\src\validation\Validator;

class RegistrationRequest extends LoginRequest
{
    protected function rules(): array
    {
        $base = parent::rules();

        return array_merge($base, [
            'username' => function ($value) {
                return Validator::make($value)
                    ->min(3)
                    ->max(32)
                    ->regex('/^[a-z0-9_]+$/');
            }
        ]);
    }
}