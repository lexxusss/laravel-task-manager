<?php

namespace App\Http\Controllers;

use App\Helpers\UserTeamStatus;
use App\Http\Requests\CollaboratorCreateRequest;
use App\Http\Requests\CollaboratorUpdateRequest;
use App\Model\Team;
use App\Model\UserTeam;
use App\Services\InvitationService;
use App\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CollaboratorsController extends Controller
{
    /**
     * @param Team $team
     * @return Factory|View
     */
    public function index(Team $team)
    {
        $collaborators = $team->getCollaborators($this->user);

        return view('collaborators.index', compact('team', 'collaborators'));
    }

    /**
     * @param Team $team
     * @return View
     */
    public function create(Team $team)
    {
        $title = "Team $team->name - create collaborator";
        $formMode = 'create';

        $collaborator = new UserTeam();

        return view('collaborators.create_edit', compact('team', 'title', 'formMode', 'collaborator'));
    }

    /**
     * @param  Team $team
     * @param  CollaboratorCreateRequest  $request
     * @return RedirectResponse
     */
    public function store(Team $team, CollaboratorCreateRequest $request)
    {
        $userCollaborator = User::firstOrCreate([
            'email' => $request->get('email'),
        ]);

        $userTeam = UserTeam::firstOrCreate([
            'user_id' => $userCollaborator->id,
            'team_id' => $team->id,
        ], [
            'is_admin' => (bool) $request->get('is_admin'),
            'supervised_by_id' => $request->get('supervised_by_id'),
            'status' => UserTeamStatus::USER_STATUS_PENDING,
        ]);

        try {
            app(InvitationService::class)->send($userTeam);
        } catch (Exception $e) {
            return redirect()
                ->route('collaborators', ['team' => $team->id])
                ->with('success',  "Collaborator $team->name was successfully created.")
                ->with('error',  sprintf(
                    "Invitation was not sent to user $userTeam->email. Details: %s",
                    $e->getMessage()
                ));
        }

        return redirect()
            ->route("collaborators", ['team' => $team->id])
            ->with('success',  "Collaborator $team->name was successfully created.")
            ->with('success',  "Invitation was successfully sent to user $userTeam->email.");
    }

    /**
     * @param Team $team
     * @param UserTeam $userTeam
     * @return View
     */
    public function edit(Team $team, UserTeam $userTeam)
    {
        $title = "Team $team->name - edit collaborator";
        $formMode = 'edit';
        $collaborator = $userTeam;

        return view('collaborators.create_edit', compact('team', 'title', 'formMode', 'collaborator'));
    }

    /**
     * @param Team $team
     * @param UserTeam $userTeam
     * @param CollaboratorUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(Team $team, UserTeam $userTeam, CollaboratorUpdateRequest $request)
    {
        $userTeam->update([
            'is_admin' => (bool) $request->get('is_admin'),
            'supervised_by_id' => $request->get('supervised_by_id'),
        ]);

        return redirect()
            ->route("collaborators", ['team' => $team->id])
            ->with('success',  "Collaborator {$userTeam->user->email} was successfully updated.");
    }

    /**
     * @param Team $team
     * @param UserTeam $userTeam
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Team $team, UserTeam $userTeam)
    {
        $userTeam->delete();

        return redirect()
            ->route("collaborators", ['team' => $team->id])
            ->with('success',  "Collaborator {$userTeam->user->email} was successfully deleted.");
    }
}
