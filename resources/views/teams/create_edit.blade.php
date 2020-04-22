
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ $title }}</div>
                <div class="card-body">
                    <a href="{{ url('/teams') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($team, [
                        'method' => $formMode === 'create' ? 'POST' : 'PATCH',
                        'url' => ['/teams', $team->id],
                        'class' => 'form-horizontal'
                    ]) !!}

                    @include ('teams.form', ['formMode' => $formMode, 'team' => $team])

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
