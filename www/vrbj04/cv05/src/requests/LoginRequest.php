<?php


namespace cv05\src\requests;


use cv05\src\validation\Validator;

class LoginRequest extends Request
{
    protected function rules(): array
    {
        return [
            'email' => function ($value) {
                return Validator::make($value)->email();
            },

            'password' => function ($value) {
                return Validator::make($value)->min(8);
            }
        ];
    }
}