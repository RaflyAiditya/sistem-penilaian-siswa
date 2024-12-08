<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $fillable = [
        'subject_name',
        'class',
        'teacher_id',
        'day',
        'time_start',
        'time_end',
        
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
        
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}