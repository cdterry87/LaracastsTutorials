@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $thread->title }}
                    </div>
                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <h3>Replies</h3>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($thread->replies as $reply)
                    <div class="panel panel-header">
                        {{ $reply->owner->name }} said {{ $reply->created_at->diffForHumans() }}
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{ $reply->body }}
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>

@endsection