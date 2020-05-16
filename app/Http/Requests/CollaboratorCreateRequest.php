<?php

namespace App\Http\Requests;

use App\Helpers\RequestsHelper;
use App\Model\Team;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class CollaboratorCreateRequest extends FormRequest
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
        /** @var Team $team */
        $team = RequestsHelper::getTeamFromRoute();
        $user = RequestsHelper::getAuthUser();

        return [
            'email' => [
                'required',
                'email',
                function($key, $value, Closure $fail) use($team, $user): void {
                    if ($user->email === $value) {
                        $fail('You cannot add yourself as collaborator');

                        return;
                    }
                    if ($team->users()->where(['email' => $value])->exists()) {
                        $fail(sprintf(
                            'User with %s="%s" is already a collaborator of team "%s"',
                            $key, $value, $team->name
                        ));

                        return;
                    }
                }
            ],
            'supervised_by_id' => 'required|exists:users_teams,id',
        ];
    }
}
