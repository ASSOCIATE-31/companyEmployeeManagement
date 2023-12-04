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
            'firstNameValue'                  => 'required',
            'lastNameValue'                   => 'required',
            'employeeEmailValue'              => [
                                                'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                                            ],
           
            'employeePhoneValue'              => [
                                              'unique:employees,phone',
                                              'numeric',
                                              'digits_between:10,10',
                                            ],
            'employeeWorkingCompanyID' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'firstNameValue.required'                  => '* Please put your first name',
            'lastNameValue.required'                   => '* Please put your last name',
            'employeeEmailValue.regex'                 => '* Please put valid email',
            'employeePhoneValue.unique'                => '* Phone number you have entered is already in use',
            'employeePhoneValue.numeric'               => '* Please put digits only',
            'employeePhoneValue.digits_between'        => '* Please put 10 digits only',
            'employeeWorkingCompanyID.required'        => '* Please select your organization'
        ];
    }
}
