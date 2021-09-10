<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditDebitRequest extends FormRequest
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
        $rules = [
            'amount' => 'required|numeric|between:0.99,499999.99', // SET MIN AND MAX AMOUNT PER TRANSACTION,
            'client_id' => 'required|integer'
        ];
        if($this->request->has('datetime')) {
            // Seems that datetime is in GMT+0
            $rules['datetime'] = 'required|date_format:Y-m-d H:i:s';
        }
        if($this->request->has('transaction_id')) {
            $rules['transaction_id'] = 'required|string|min:15|max:75';
        }
        return $rules;
    }
}
