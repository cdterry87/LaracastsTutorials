<div class="panel panel-header">
    <a href="#">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}
</div>
<div class="panel panel-default">
    <div class="panel-body">
        {{ $reply->body }}
    </div>
</div>