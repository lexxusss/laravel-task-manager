@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($teams as $team)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{ url('tasks', ['team' => $team->id]) }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4 btn">
                        <div class="card-body text-center">
                            <div class="content">
                                <p class="lead text-primary text-24 mb-2">{{ $team->name }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('new_team') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="lead text-success text-24 mb-2">Create new team</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
