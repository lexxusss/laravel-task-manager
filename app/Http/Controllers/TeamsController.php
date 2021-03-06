<?php

namespace App\Http\Controllers;

use App\Helpers\UserTeamStatus;
use App\Http\Requests\TeamRequest;
use App\Model\Team;
use App\Model\UserTeam;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TeamsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function create()
    {
        $title = 'Create team';
        $formMode = 'create';

        $team = new Team();

        return view('teams.create_edit', compact('title', 'formMode', 'team'));
    }

    /**
     * @param TeamRequest $request
     * @return RedirectResponse
     */
    public function store(TeamRequest $request)
    {
        $team = Team::create($request->all());

        UserTeam::create([
            'user_id' => $this->user->id,
            'team_id' => $team->id,
            'is_admin' => true,
            'supervised_by_id' => null,
            'status' => UserTeamStatus::USER_STATUS_ACTIVE,
        ]);

        return redirect()->route('teams')->with('success',  "Team $team->name was successfully created.");
    }

    /**
     * @param Team $team
     * @return Factory|View
     */
    public function edit(Team $team)
    {
        $title = 'Edit team';
        $formMode = 'edit';

        return view('teams.create_edit', compact('title', 'formMode', 'team'));
    }

    /**
     * @param TeamRequest $request
     * @param Team $team
     * @return RedirectResponse
     */
    public function update(TeamRequest $request, Team $team)
    {
        $team->update($request->all());

        return redirect()->route('teams')->with('success',  "Team $team->name was successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
