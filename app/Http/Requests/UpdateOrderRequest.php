<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_edit');
    }

    public function rules()
    {
        return [
            'order_code' => [
                'string',
                'nullable',
            ],
            'from' => [
                'required',
            ],
            'to' => [
                'required',
            ],
            'weight' => [
                'string',
                'nullable',
            ],
            'chargeable' => [
                'string',
                'nullable',
            ],
            'pieces' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'pickup_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'destination' => [
                'string',
                'nullable',
            ],
        ];
    }
}
