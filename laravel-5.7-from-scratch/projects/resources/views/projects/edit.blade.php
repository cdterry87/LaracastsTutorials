@extends('layout')

@section('content')
    <h1 class="title">Edit Project</h1>

    @include('errors')

    <form method="POST" action="/projects/{{ $project->id }}">
        @csrf
        @method('PATCH')
        <div class="field">
            <label for="title" class="label">Title</label>
            <div class="control">
                <input type="text" class="input" id="title" name="title" placeholder="title" value="{{ $project->title }}">
            </div>
        </div>
        <div class="field">
            <label for="description" class="label">Description</label>
            <div class="control">
                <textarea name="description" id="description" cols="30" rows="10" class="textarea">{{ $project->description }}</textarea>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-info">Update Project</button>
            </div>
        </div>
    </form>
@endsection
