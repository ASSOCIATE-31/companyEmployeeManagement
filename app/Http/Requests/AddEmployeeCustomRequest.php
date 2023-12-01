<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEmployeeCustomRequest extends FormRequest
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
            'firstName'                  => 'required',
            'lastName'                   => 'required',
            'employeeEmail'              => [
                                                'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                                            ],
           
            'employeePhone'              => [
                                              'numeric',
                                              'digits_between:10,10',
                                            ],
            'employeeWorkingCompanyName' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'firstName.required'                  => '* Please put your first name',
            'lastName.required'                   => '* Please put your last name',
            'employeeEmail.regex'                 => '* Please put valid email',
            'employeePhone.numeric'               => '* Please put digits only',
            'employeePhone.digits_between'        => '* Please put 10 digits only',
            'employeeWorkingCompanyName.required' => '* Please select your organization'
        ];
    }
}
