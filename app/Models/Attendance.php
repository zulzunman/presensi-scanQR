<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'teacher_id', 'date', 'time', 'location', 'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public static function generateQrCode($teacher_id)
    {
        $data = route('attendances.scan', ['teacher_id' => $teacher_id]);
        return QrCode::size(300)->generate($data);
    }
}
