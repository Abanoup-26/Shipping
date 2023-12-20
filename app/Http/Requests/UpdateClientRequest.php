<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'company_name' => [
                'string',
                'required',
            ],
            'shop_name' => [
                'string',
                'required',
            ],
            'commerical_record' => [
                'required',
            ],
        ];
    }
}
