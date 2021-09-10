<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThresholdRequest extends FormRequest
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
        $rules['client_id'] = 'required|integer';
        if($this->request->has('start_date')) {
            $rules['start_date'] = 'required|date';
        } else {
            $rules['end_date'] = 'required|date';
        }
        if($this->request->has('end_date')) {
            $rules['end_date'] = 'required|date';
        } else {
            $rules['start_date'] = 'required|date';
        }
        return $rules;
    }
}
