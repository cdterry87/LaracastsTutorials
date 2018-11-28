@extends('layout')

@section('content')
    <h1 class="title">Projects</h1>

    @foreach($projects as $project)
        <li>{{ $project->title }}</li>
    @endforeach
@endsection
