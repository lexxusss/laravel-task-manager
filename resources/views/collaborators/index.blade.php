
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Team <b>{{ $team->name }}</b> - collaborators</h1>
        <hr>
        <a type="button" class="btn btn-outline-info mb-4" href="{{ route('create_collaborator', ['team' => $team->id]) }}">Add new collaborator</a>
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
                        <td>{{ ($collaboratorEmail = ($collaborator->supervisor->email ?? null)) === $user->email ? "$user->email (You)" : $collaboratorEmail }}</td>
                        <td>{{ $collaborator->is_admin }}</td>
                        <td>
                            {{ $collaborator->status }}
                            <form
                                id="send_invitation_{{ $collaborator->id }}"
                                method="POST"
                                action="{{ route('send_invitation', ['team' => $team->id, 'userTeam' => $collaborator->id]) }}"
                                accept-charset="UTF-8"
                                style="display:inline"
                                onsubmit="confirm('Are you sure you want ot send invitation to {{ $collaborator->user->email }}')"
                            >
                                {{ csrf_field() }}
                                <input name="email" type="hidden" value="{{ $collaborator->user->email }}">
                                <a
                                    href="javascript:void(0);"
                                    class="text-primary mr-2"
                                    onclick="$('#send_invitation_{{ $collaborator->id }}').submit()"
                                >
                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                </a>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('edit_collaborator', ['team' => $team->id, 'userTeam' => $collaborator->id]) }}">
                                <i class="fa fa-edit colour-orange pointer mr-2"></i>
                            </a>
                            <i class="fa fa-trash colour-red pointer"
                               onclick="confirmAction(function() {
                                 location.href = '{{ route("destroy_collaborator", ["team" => $team->id, "userTeam" => $collaborator->id]) }}';
                               })"
                            ></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
