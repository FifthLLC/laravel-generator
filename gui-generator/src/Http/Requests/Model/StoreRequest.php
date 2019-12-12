<?php

namespace Fifth\GuiGenerator\Http\Requests\Model;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


/**
 * @property mixed name
 */
class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'withTimestamps' => '',
            'fields' => 'required|array',
            'fields.*.name' => 'required|string',
            'fields.*.type' => 'required|string',
        ];
    }
}
