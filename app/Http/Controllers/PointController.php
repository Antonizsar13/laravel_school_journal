<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePointRequest;
use App\Http\Requests\UpdatePointRequest;
use App\Models\AcademicDiscipline;
use App\Models\LearningClass;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $learningClasses = LearningClass::with(['users' => function ($query) {
            $query->with(['roles']);
        }, 'academicDisciplines'])->get();

        return view('point.index', ['learningClasses' => $learningClasses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->get();

        $disciplines = AcademicDiscipline::all();

        return view('point.create', ['students' => $students, 'disciplines' => $disciplines]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePointRequest $request)
    {
        Point::create($request->validated());

        return back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Point $point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePointRequest $request, Point $point)
    {
        $point->fill($request->validated());
        $point->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Point $point)
    {
        $point->delete();
        return back();
    }

    public function classes(){
        $learningClasses = LearningClass::with(['academicDisciplines', 'users' => function ($query) {
            $query->with(['roles']);
        }])->get();

        return view('point.classes', ['learningClasses' => $learningClasses]);
    }

    public function disciplineList(LearningClass $learningClass){
        $disciplines = $learningClass->academicDisciplines()->with(['users' => function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'teacher');
            });
        }])->get();

        return view('point.discipline_list', ['learningClass' => $learningClass,'disciplines' => $disciplines]);
    }

    public function disciplinePointsList(LearningClass $learningClass, AcademicDiscipline $academicDiscipline)
    {

        $studentsClass = $learningClass->users()->with(['roles' => function ($query) {
            $query->where('name', 'student');
        },
        'points' => function($query) use (&$academicDiscipline){
            $query->where('academic_discipline_id', $academicDiscipline->id );
        }
        ])->get();

        

        
        return view('point.discipline_points_list', ['learningClass' => $learningClass,'discipline' => $academicDiscipline, 'studentsClass' => $studentsClass]);
    }

    public function editPointUser(AcademicDiscipline $academicDiscipline, User $user)
    {
        $points = $user->pointsDiscipline($academicDiscipline)->get();
        
        return view('point.edit_point_user', ['user' => $user, 'points' => $points, 'discipline' => $academicDiscipline]);
    }

    public function createPointUser(AcademicDiscipline $academicDiscipline, User $user)
    {

        return view('point.create_point_user', ['user' => $user, 'discipline' => $academicDiscipline]);
    }

    public function myPoints()
    {
        $user = auth()->user();

        $disciplines = $user->learningClasses()->first()
            ->academicDisciplines()
            ->with('points', function($query) use (&$user) {
                $query->where('user_id', $user->id);
                // $query->addSelect('avg(point)');
            })
            ->get();

        return view('point.my_points', ['disciplines' => $disciplines ]);
    }
}
