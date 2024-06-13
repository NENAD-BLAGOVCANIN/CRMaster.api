<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const STATUS_TODO = 'todo';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_ON_HOLD = 'on_hold';
    const STATUS_DONE = 'done';

    protected $fillable = [
        'subject',
        'description',
        'waiting_on',
        'submodule_id',
        'assigned_to',
        'status',
        'due_date'
    ];

    public function assignees()
    {
        return $this->belongsToMany(User::class, 'task_assignees');
    }

}
