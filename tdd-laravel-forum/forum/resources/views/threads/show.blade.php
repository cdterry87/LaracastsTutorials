@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{ $thread->creator->name }}</a> posted:
                        {{ $thread->title }}
                    </div>
                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <h3>Replies</h3>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                    <hr>
                @endforeach
            </div>
        </div>

        @if(auth()->check())
            <h3>Add a Reply</h3>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form method="post" action="{{ $thread->path() . '/replies' }}">
                        @csrf
                        <div class="form-group">
                            <textarea name="body" id="body" rows="5" class="form-control" placeholder="Have something to say?"></textarea>
                        </div>
                        <button class="btn btn-default" type="submit">Post</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="/login">sign in</a> to participate in this discussion.</p>
        @endif
    </div>

@endsection