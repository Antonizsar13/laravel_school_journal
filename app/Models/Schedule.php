<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_of_the_week',
        'learning_class_id',
    ];

    public function academicDisciplines(){
        return $this->belongsToMany(AcademicDiscipline::class, 'schedule_academic_dicipline')->withPivot('number')->orderBy('schedule_academic_dicipline.number');
    }

    public function learningClass(){
        return $this->belongsTo(LearningClass::class);
    }
}
