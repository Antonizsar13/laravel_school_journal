<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePointRequest;
use App\Http\Requests\UpdatePointRequest;
use App\Models\AcademicDiscipline;
use App\Models\LearningClass;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;

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
        $learningClasses = LearningClass::with(['users' => function ($query) {
            $query->with(['roles']);
        }])->get();

        return view('point.classes', ['learningClasses' => $learningClasses]);
    }

    public function disciplineList(LearningClass $learningClass){
        $disciplines = $learningClass->academicDisciplines()->get();

        return view('point.discipline_list', ['learningClass' => $learningClass,'disciplines' => $disciplines]);
    }

    public function disciplinePointsList(LearningClass $learningClass, AcademicDiscipline $discipline)
    {
        $users = $learningClass->users()->get();

        $studentsClass = array();
        foreach ($users as $user) {
            if (($user['roles'][0]['name']) == 'Student'){
                array_push($studentsClass, $user);
                //убрать из блейда оценки и сюда
            }
        }
        
        return view('point.discipline_points_list', ['learningClass' => $learningClass,'discipline' => $discipline, 'studentsClass' => $studentsClass]);
    }

    public function editPointUser(AcademicDiscipline $discipline, User $user)
    {
        $points = $user->pointsDiscipline($discipline)->get();
        
        return view('point.edit_point_user', ['user' => $user, 'points' => $points, 'discipline' => $discipline]);
    }

    public function createPointUser(AcademicDiscipline $discipline, User $user)
    {
        return view('point.create_point_user', ['user' => $user, 'discipline' => $discipline]);
    }

    public function myPoints()
    {
        $user = auth()->user();

        $disciplines = $user->learningClasses()->first()->academicDisciplines()->get();

        return view('point.my_points', ['user' => $user, 'disciplines' => $disciplines ]);
    }
}
