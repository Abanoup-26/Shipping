<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_edit');
    }

    public function rules()
    {
        $clientId = $this->route('client');

        return [
            'name' => 'required',
            'password' => 'required',
            'company_name' => [
                'string',
                'required',
            ],
            'shop_name' => [
                'string',
                'required',
            ],
        ];
    }
}
