<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectName extends Model
{
    use HasFactory;

    protected $table = 'subject_names';
    protected $fillable = [
        'subject_name_id',
        'subject_name',
    ];

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'subject_name_id', 'subject_name_id');
    }
}
