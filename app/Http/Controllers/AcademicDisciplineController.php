<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcademicDisciplineRequest;
use App\Http\Requests\UpdateAcademicDisciplineRequest;
use App\Models\AcademicDiscipline;
use App\Models\LearningClass;
use App\Models\User;
use Illuminate\Http\Request;

class AcademicDisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academicDiscipline = AcademicDiscipline::with('users', 'learningClasses')->get();

        return view('academic_discipline.index', ['disciplines' => $academicDiscipline]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        $learningClasses = LearningClass::all();

        return view('academic_discipline.create', ['teachers' => $teachers, 'learningClasses' => $learningClasses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcademicDisciplineRequest $request)
    {
        $newDiscipline = AcademicDiscipline::create($request->validated());

        if (array_key_exists('teachers', $request->validated()))
            foreach ($request->validated()['teachers'] as $id) {
                $user = User::find($id);
                $newDiscipline->users()->attach($user);
            }

        if (array_key_exists('learningClasses', $request->validated()))
            foreach ($request->validated()['learningClasses'] as $id) {
                $learningClass = LearningClass::find($id);
                $newDiscipline->learningClasses()->attach($learningClass);
            }

        return redirect('academic_discipline');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicDiscipline $academicDiscipline)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicDiscipline $academicDiscipline)
    {
        $teachersDiscipline = $academicDiscipline->users()->whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        $learningClassesDiscipline = $academicDiscipline->learningClasses;

        $learningClasses = LearningClass::all();


        return view('academic_discipline.edit', [
            'discipline' => $academicDiscipline,
            'teachers' => $teachers,
            'teachersDiscipline' => $teachersDiscipline,
            'learningClassesDiscipline' => $learningClassesDiscipline,
            'learningClasses'  => $learningClasses
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicDisciplineRequest $request, AcademicDiscipline $academicDiscipline)
    {
        
        $academicDiscipline->fill($request->validated());
        $academicDiscipline->save();

        $users = array();
        if (array_key_exists('teachers', $request->validated())) {

            foreach ($request->validated()['teachers'] as $id) {
                array_push($users, $id);
            }
        }
        $academicDiscipline->users()->sync($users);


        $learningClasses = array();
        if (array_key_exists('learningClasses', $request->validated())) {
            foreach ($request->validated()['learningClasses'] as $id) {
                array_push($learningClasses, $id);
            }
        }
        $academicDiscipline->learningClasses()->sync($learningClasses);


        return redirect('academic_discipline');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicDiscipline $academicDiscipline)
    {
        // $academicDiscipline->users()->sync(array()); //костыль
        // $academicDiscipline->learningClasses()->sync(array()); //костыль
        // $academicDiscipline->homeworks()->delete();
        // $academicDiscipline->points()->delete();
        // $academicDiscipline->schedules()->delete(); //костыль
        // $academicDiscipline->delete();
        // return AcademicDisciplineController::index();
        //сделать мягкое удаление



        return redirect('academic_discipline');
    }

    public function myDiscipline()
    {
        $disciplines = (auth()->user())->academicDisciplines()->with('learningClasses')->get();

        return view('academic_discipline.teacher.my_discipline', ['disciplines' => $disciplines]);
    }

    public function myDisciplineClasses(AcademicDiscipline $academicDiscipline)
    {
        $learningClasses = $academicDiscipline->learningClasses()->with('users',function ($query){
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'Student');
            });
        })
        ->get(); 

        return view('academic_discipline.teacher.my_discipline_classes', ['learningClasses' => $learningClasses, 'discipline' => $academicDiscipline]);   }

    public function myDisciplineClassStudents(AcademicDiscipline $academicDiscipline, LearningClass $learningClass)
    { 
        $students = $learningClass->users()->with('points')->get();
        

        return view('academic_discipline.teacher.my_discipline_class_students', ['students' => $students, 'discipline' => $academicDiscipline, 'learningClass' => $learningClass]);
    }
}
