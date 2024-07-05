<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'schedule_id',
    ];

    public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }

    public function schedules()
    {
        return $this->belongsTo(Schedule::class);
    }
}
