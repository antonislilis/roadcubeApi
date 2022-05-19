<?php

namespace App\Http\Requests;

class StoreStoreSearchRequest extends Request
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

   /* function validationData()
    {
        return $this->json()->all();
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return
            [
                'name' => 'string|max:120|min:3',
                'app_name' => 'string|max:200|min:3',
                'address' => 'string|max:300|min:3',
                'lat' => 'numeric|required_with:lon,radius',
                'lon' => 'numeric|required_with:lat,radius',
                'radius' => 'numeric|required_with:lat,lon',
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
