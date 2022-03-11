<?php

namespace Modules\OurTeam\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OurTeamFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() === 'POST') {
            return [
                'name' => "required|alpha_spaces|unique:ourteams,name",
                'image' => "max:3072|image",
                'description' => "required",
                'position' => "required"
            ];
        } else {
            return [
                'name' => "required|alpha_spaces|unique:ourteams,name,{$this->ourteam->id}",
                'image' => "max:3072|image",
                'description' => "required",
                'position' => "required"
            ];
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
