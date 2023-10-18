<?php

namespace App\Http\Requests;

use App\Models\Room;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRoomRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('room_edit');
    }

    public function rules()
    {
        return [
            'hostel_id' => [
                'required',
                'integer',
            ],
            'room_info' => [
                'string',
                'required',
            ],
            'images' => [
                'array',
            ],
        ];
    }
}
