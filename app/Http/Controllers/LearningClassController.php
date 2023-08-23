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

        if (array_key_exists('students', $request->validated()))
        foreach ($request->validated()['students'] as $id) {
            $user = User::find($id);
            $newLearningClasses->users()->attach($user);
        }
        
        if (array_key_exists('disciplines', $request->validated()))
        foreach ($request->validated()['disciplines'] as $id) {
            $discipline = AcademicDiscipline::find($id);
            $newLearningClasses->academicDisciplines()->attach($discipline);
        }
        return redirect('learning_class');
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
        $studentsClass = $learningClass->users()->whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->get();

        $teacherClass = $learningClass->users()->whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get()[0];

        

        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        $students = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->get();

        $academicDisciplines = AcademicDiscipline::all();

        $disciplinesClass = $learningClass->academicDisciplines;

        return view('learning_class.edit', ['learningClass' => $learningClass,
                                            'teachers' => $teachers, 
                                            'students' => $students, 
                                            'teacherClass' => $teacherClass, 
                                            'studentsClass' => $studentsClass,
                                            'disciplinesClass'=> $disciplinesClass,
                                            'disciplines' => $academicDisciplines]);
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

        return redirect('learning_class');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LearningClass $learningClass)
    {
        // $learningClass->users()->sync(array()); //костыль
        // $learningClass->academicDisciplines()->sync(array()); //костыль

        // $learningClass->delete();

        //сделать софт делете
        return redirect('learning_class');
    }
}
