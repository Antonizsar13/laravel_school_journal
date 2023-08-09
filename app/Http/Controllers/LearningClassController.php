<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLearningClassRequest;
use App\Models\AcademicDiscipline;
use App\Models\LearningClass;
use App\Models\User;
use Illuminate\Http\Request;

class LearningClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $learningClasses = LearningClass::with(['users' => function($query) {
            $query->with(['roles']);
        }, 'academicDisciplines'])->get();

        return view('learning_class.index', ['learningClasses' => $learningClasses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->get();


        $disciplines = AcademicDiscipline::all();

        return view('learning_class.create', ['teachers' => $teachers, 'students' => $students, 'disciplines' => $disciplines]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLearningClassRequest $request)
    {   
        $newLearningClasses = LearningClass::create($request->validated());

        foreach ($request->validated()['students'] as $id) {
            $user = User::find($id);
            $newLearningClasses->users()->attach($user);
        }

        foreach ($request->validated()['disciplines'] as $id) {
            $discipline = AcademicDiscipline::find($id);
            $newLearningClasses->academicDisciplines()->attach($discipline);
        }
        return LearningClassController::index();
    }

    /**
     * Display the specified resource.
     */
    public function show(LearningClass $learningClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LearningClass $learningClass)
    {
        $usersClass = $learningClass->users()->get(); //все но можно только учителе сделать потом

        $studentsClass = array();

        $teacherClass = 0;
        foreach ($usersClass as $user) {
            if(($user['roles'][0]['name']) == 'Teacher')
                $teacherClass = $user->id;
            else
                array_push($studentsClass, $user->id);        
        }

        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->get();

        $academicDisciplines = AcademicDiscipline::all();

        $disciplinesClass = $learningClass->academicDisciplines()->get();

        return view('learning_class.edit', ['learningClass' => $learningClass,
                                            'teachers' => $teachers, 
                                            'students' => $students, 
                                            'teacherClass' => $teacherClass, 
                                            'studentsClass' => $studentsClass,
                                            'disciplinesClass'=> $disciplinesClass,
                                            'academicDisciplines' => $academicDisciplines]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLearningClassRequest $request, LearningClass $learningClass)
    {
        $learningClass->fill($request->validated());
        $learningClass->save();

        $users = array();
        if (array_key_exists('students', $request->validated())) {

            foreach ($request->validated()['students'] as $id) {
                array_push($users, $id);
            }
        }
        $learningClass->users()->sync($users);

        $disciplines = array();
        if (array_key_exists('disciplines', $request->validated())) {

            foreach ($request->validated()['disciplines'] as $id) {
                array_push($disciplines, $id);
            }
        }
        $learningClass->academicDisciplines()->sync($disciplines);

        return LearningClassController::index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LearningClass $learningClass)
    {
        $learningClass->users()->sync(array()); //костыль
        $learningClass->academicDisciplines()->sync(array()); //костыль

        $learningClass->delete();
        return LearningClassController::index();
    }
}
