
@if($formMode === 'edit')
    <h3>{{ $collaborator->user->email }}</h3>
@else
    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
        {!! $errors->first('email', '<p class="alert-danger">:message</p>') !!}
    </div>
@endif

<div class="form-group {{ $errors->has('is_admin') ? 'has-error' : ''}}">
    {!! Form::label('is_admin', 'Is admin', ['class' => 'control-label']) !!}
    {!! Form::checkbox('is_admin', 1, old('is_admin', $collaborator->is_admin), ['class' => 'form-control']) !!}
    {!! $errors->first('is_admin', '<p class="alert-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('supervised_by_id') ? 'has-error' : ''}}">
    {!! Form::label('supervised_by_id', 'Supervisor', ['class' => 'control-label']) !!}
    {!! Form::select(
        'supervised_by_id',
        $team->getCollaborators($collaborator->user)
            ->keyBy(function (\App\Model\UserTeam $userTeam) {
                return $userTeam->user->id;
            })
            ->map(function (\App\Model\UserTeam $userTeam) use ($user) {
                $email = $userTeam->user->email;

                if ($email === $user->email) {
                    $email .= ' (You)';
                }

                return $email;
            }),
        old('supervised_by_id', $collaborator->supervised_by_id),
        ['class' => 'form-control', 'required' => 'required']
      ) !!}
    {!! $errors->first('supervised_by_id', '<p class="alert-danger">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
