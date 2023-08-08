<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'specialization',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function academicDisciplines()
    {
        return $this->belongsToMany(AcademicDiscipline::class, 'a_discipline_l_class');
    }
    
}
