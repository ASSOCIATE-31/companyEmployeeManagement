<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCompanyRequest extends FormRequest
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
            'companyName' => 'required',
            'companyLogo' => [
                                'image',
                                'dimensions : min_width:100, min_height:100',
                             ],
        ];
    }
    public function messages()
    {
        return [
            'companyName.required'   => '* Company name required Custom Request',
            'companyLogo.image'      => '* Not an image',    
            'companyLogo.dimensions' => '* Minimum width is 100*100 px ',
        ];
    }
}
