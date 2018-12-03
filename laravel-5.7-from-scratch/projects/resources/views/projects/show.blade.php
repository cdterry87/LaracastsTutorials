@extends('layout')

@section('content')
    <h1 class="title">{{ $project->title }}</h1>
    <div class="content">
        {{ $project->description }}

        <p>
            <a href="/projects/{{ $project->id }}/edit">Edit</a>
        </p>
    </div>

    @if ($project->tasks->count())
        <div class="box">
            <label for="" class="label">Tasks</label>
            @foreach ($project->tasks as $task)
                <div>
                <form method="POST" action="/tasks/{{ $task->id }}">
                        @method('PATCH')
                        @csrf
                        <label class="checkbox {{ $task->completed ? 'is-complete' : '' }}" for="completed">
                            <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                            {{ $task->description }}
                        </label>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

    <form action="/projects/{{ $project->id }}/tasks" method="POST" class="box">
        @csrf
        <div class="field">
            <label for="description" class="label">New Task</label>
            @include('errors')
            <div class="control">
                <input type="text" class="input" name="description" id="description" placeholder="New Task">
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Add Task</button>
            </div>
        </div>
    </form>


@endsection
