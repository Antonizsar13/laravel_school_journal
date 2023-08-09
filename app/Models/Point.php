<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'point',
        'user_id',
        'academic_discipline_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function academicDisciplines(){
        return $this->belongsTo(AcademicDiscipline::class);
    }
}
