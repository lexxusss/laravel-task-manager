
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
    {!! Form::email('email', old('email', $collaborator->email), ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('is_admin') ? 'has-error' : ''}}">
    {!! Form::label('is_admin', 'Is admin', ['class' => 'control-label']) !!}
    {!! Form::checkbox('is_admin', 1, old('is_admin', $collaborator->is_admin), ['class' => 'form-control']) !!}
    {!! $errors->first('is_admin', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('supervised_by_id') ? 'has-error' : ''}}">
    {!! Form::label('supervised_by_id', 'Supervisor', ['class' => 'control-label']) !!}
    {!! Form::select('supervised_by_id', $team->users->pluck('email', 'id'), old('supervised_by_id', $collaborator->supervised_by_id), ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('supervised_by_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
