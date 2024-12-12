<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $fillable = [
        'subject_name_id',
        'class',
        'teacher_id',
        'day',
        'time_start',
        'time_end',
        
    ];

    public function subjectName()
    {
        return $this->belongsTo(SubjectName::class, 'subject_name_id', 'subject_name_id');
    }
        
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    protected function timeStart(): Attribute
{
    return Attribute::make(
        get: fn ($value) => date('H:i', strtotime($value)),
    );
}

protected function timeEnd(): Attribute
{
    return Attribute::make(
        get: fn ($value) => date('H:i', strtotime($value)),
    );
}
}