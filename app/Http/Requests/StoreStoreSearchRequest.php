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
            'lat.required_with' => 'In order to make an area search, Latitude, Longitude and Radius fields are required',
            'lon.required_with' => 'In order to make an area search, Latitude, Longitude and Radius fields are required',
            'radius.required_with' => 'In order to make an area search, Latitude, Longitude and Radius fields are required',
        ];
    }


}
