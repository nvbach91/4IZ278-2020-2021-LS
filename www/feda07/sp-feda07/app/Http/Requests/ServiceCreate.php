<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class ServiceCreate
 * @package App\Http\Requests
 * @property string $name
 * @property string $description
 * @property int $duration
 */
class ServiceCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['name' => "string", 'description' => "string", 'duration' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'duration' => 'required|numeric|gt:0' // numeric= brat jako cislo , gt=vetsi nez
        ];
    }
}
