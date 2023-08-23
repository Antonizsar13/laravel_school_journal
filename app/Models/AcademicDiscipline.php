<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicDiscipline extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function learningClasses(){
        return $this->belongsToMany(LearningClass::class, 'a_discipline_l_class');
    }

    public function schedules(){
        return $this->belongsToMany(Schedule::class, 'schedule_academic_dicipline')->withPivot('number');
    }
    
    public function points(){
        return $this->hasMany(Point::class);
    }

    public function homeworks(){
        return $this->hasMany(Homework::class);
    }

}
