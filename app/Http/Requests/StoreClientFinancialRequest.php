<?php

namespace App\Http\Requests;

use App\Models\ClientFinancial;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClientFinancialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_financial_create');
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
