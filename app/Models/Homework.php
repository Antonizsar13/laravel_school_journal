<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $fillable = [
        'task',
        'date',
        'learning_class_id',
        'academic_discipline_id',
    ];

    public function learningClass(){
        return $this->belongsTo(LearningClass::class);
    }

    public function academicDiscipline(){
        return $this->belongsTo(AcademicDiscipline::class);
    }
}
