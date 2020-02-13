<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    protected $casts = [
        'completed' => 'boolean'
    ];

    // 当task被更新时，它对应当project也会随之更新
    protected $touches = ['project'];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    public function complete()
    {
        $this->update(['completed' => true]);
        $this->project->recordActivity('completed_task');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
        $this->project->recordActivity('incompleted_task');
    }
}
