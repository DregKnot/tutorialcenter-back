<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectsEnrollment extends Model
{
    use SoftDeletes;

    protected $table = 'subjects_enrollments';

    protected $fillable = [
        'course_enrollment',
        'subject',
        'student',
        'progress',
    ];

    protected $casts = [
        'progress' => 'float',
    ];

    public function enrollment()
    {
        return $this->belongsTo(CoursesEnrollment::class, 'course_enrollment');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject');
    }

}
