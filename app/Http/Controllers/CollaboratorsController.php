<?php

namespace App\Http\Controllers;

use App\Model\Team;
use App\Model\UserTeam;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @return Factory|View
     */
    public function create(Team $team)
    {
        $title = "Team $team->name - create collaborator";
        $formMode = 'create';

        $collaborator = new UserTeam();

        return view('collaborators.create_edit', compact('team', 'title', 'formMode', 'collaborator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
