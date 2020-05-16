
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    <a href="{{ route('collaborators', ['team' => $team->id]) }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    {!! Form::model($collaborator, [
                        'method' => $formMode === 'create' ? 'POST' : 'PATCH',
                        'url' => ['/team/' . $team->id . '/collaborators', $collaborator->id],
                        'class' => 'form-horizontal'
                    ]) !!}

                    @include ('collaborators.form', ['formMode' => $formMode, 'collaborator' => $collaborator])

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
