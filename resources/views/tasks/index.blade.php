
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Tasks</h1>
            <table class="table table-striped table-hover table-reflow">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>File</th>
                    <th>Time range</th>
                    <th>State</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->file }}</td>
                        <td>{{ $task->time_from }} - {{ $task->time_to }}</td>
                        <td>{{ $task->is_closed ? 'closed' : $task->state }}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
