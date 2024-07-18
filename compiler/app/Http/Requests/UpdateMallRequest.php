<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMallRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'sometimes|required|max:255',
            'address'=>'sometimes|required|max:255',
            'phone'=>'sometimes|required|max:255',
            'manager_id'=>'sometimes|required|exists:managers,id',
        ];
    }
}
