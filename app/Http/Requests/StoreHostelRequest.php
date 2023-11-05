<?php

namespace App\Http\Requests;

use App\Models\Hostel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHostelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hostel_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'built_on' => [
                'string',
                'max:4',
                'nullable',
            ],
            'total_seat' => [
                'string',
                'required',
            ],
            'garage' => [
                'string',
                'nullable',
            ],
            'garage_size' => [
                'string',
                'nullable',
            ],
            'area_id' => [
                'required',
                'integer',
            ],
            'facilities.*' => [
                'integer',
            ],
            'facilities' => [
                'array',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'required',
                'array',
            ],
            'featured_image' => [
                'required',
            ],
        ];
    }
}
