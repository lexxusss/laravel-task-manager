
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Team <b>{{ $team->name }}</b> - collaborators</h1>
        <hr>
        <a type="button" class="btn btn-outline-info mb-4" href="{{ route('new_collaborator', ['team' => $team->id]) }}">Add new collaborator</a>
        <div class="row justify-content-center">

            <table class="table table-striped table-hover table-reflow">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Supervisor</th>
                    <th>Is admin</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($collaborators as $collaborator)
                    <tr>
                        <td>{{ $collaborator->user->email }}</td>
                        <td>{{ $collaborator->supervisor->email ?? null }}</td>
                        <td>{{ $collaborator->is_admin }}</td>
                        <td>{{ $collaborator->status }}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
