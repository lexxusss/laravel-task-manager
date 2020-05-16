<?php

namespace App\Http\Requests;

use App\Helpers\RequestsHelper;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class CollaboratorUpdateRequest extends FormRequest
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
        $collaborator = RequestsHelper::getUserTeamFromRoute();

        return [
            'supervised_by_id' => [
                'required',
                'exists:users_teams,id',
                function($key, $value, Closure $fail) use ($collaborator): void {
                    if ($collaborator->id === $value) {
                        $fail('You cannot add user himself as supervisor');
                    }
                }
            ],
        ];
    }
}
