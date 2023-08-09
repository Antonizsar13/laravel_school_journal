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

    public function points(){
        return $this->hasMany(Point::class);
    }
}
