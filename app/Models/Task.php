<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'priority',
        'completed',
    ];

     /**
     * Relasi ke Subtask.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subtasks(): HasMany
    {
        return $this->hasMany(Subtask::class);
    }
}
