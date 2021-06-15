<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           // 'name' => 'max:255|null',
           // 'surname' => 'max:255|null',
           // 'phoneNumber' => 'max:255|null',
           // 'aboutMe' => 'max:255|null',
           // 'avatar' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2047|null',
        ];
    }
}
