<?php

namespace App\Http\Requests;

class StoreStoreRequest extends Request
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

    function validationData()
    {
        return $this->json()->all();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return
            [
                'parent_id' => 'numeric|required',
                'store_type_id' => 'numeric|required',
                'name' => 'string|max:120|min:3|required',
                'app_name' => 'string|max:200|min:3|required',
                'address' => 'string|max:300|min:3|required',
                'zip' => 'digits:5|max:15|required',
                'email' => 'required|email',
                'lat' => 'numeric',
                'lon' => 'numeric',
            ];

    }


    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'lat.numeric' => 'Latitude must be number like (38.0113900)',
            'lon.numeric' => 'Longitude must be number like (23.7513200)',
        ];
    }

}
