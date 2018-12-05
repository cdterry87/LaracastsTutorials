<?php

namespace App;

use App\Events\ProjectCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $dispatchesEvents = [
        'created' => ProjectCreated::class,
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function addTask($task)
    {
        $this->tasks()->create($task);
    }
}
