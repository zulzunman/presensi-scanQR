<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip', 'name', 'jenis_kelamin', 'subject_id', 'user_id', 'qr_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
