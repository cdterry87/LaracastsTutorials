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
}
