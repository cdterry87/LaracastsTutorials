@extends('layout')

@section('content')
    <h1 class="title">Create New Project</h1>

    @include('errors')

    <form action="/projects" method="POST">
        @csrf
        <div class="field">
            <label for="title" class="label">Project Title</label>
            <div class="control">
            <input type="text" class="input {{ $errors->has('title') ? 'is-danger' : '' }}" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
            </div>
        </div>
        <div class="field">
            <label for="description" class="label">Project Description</label>
            <div class="control">
                <textarea name="description" id="description" cols="30" rows="10" class="textarea {{ $errors->has('title') ? 'is-danger' : '' }}">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-success">Create Project</button>
            </div>
        </div>
    </form>
@endsection
