<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\ValidationRules\Rules\Currency;


class QuotationStoreRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'age' => 'required|string|regex:/^(\d+(,\d+)*)?$/',
            'currency_id' => ['required', new Currency()],
            'start_date' => 'required|string|date_format:Y-m-d',
            'end_date' => 'required|string|date_format:Y-m-d',
        ];
    }
}
