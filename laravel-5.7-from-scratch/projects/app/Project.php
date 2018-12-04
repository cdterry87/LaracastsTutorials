<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [
        'id'
    ];

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function addTask($task) {
        $this->tasks()->create($task);
    }
}
