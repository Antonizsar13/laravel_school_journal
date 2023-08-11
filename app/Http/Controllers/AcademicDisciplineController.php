<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcademicDisciplineRequest;
use App\Http\Requests\UpdateAcademicDisciplineRequest;
use App\Models\AcademicDiscipline;
use App\Models\LearningClass;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AcademicDisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $academicDiscipline = AcademicDiscipline::with('users', 'learningClasses')->get();

        return view('discipline.index', ['disciplines' => $academicDiscipline]);
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

        return view('discipline.create', ['teachers' => $teachers, 'learningClasses' => $learningClasses]);
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

        return AcademicDisciplineController::index();
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
    public function edit(int $academicDiscipline)
    {

        $academicDiscipline = AcademicDiscipline::find($academicDiscipline); //!!!!!!!!!!!!

        $teachersDiscipline = $academicDiscipline->users()->get(); //все но можно только учителе сделать потом

        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        $learningClassesDiscipline = $academicDiscipline->learningClasses()->get();

        $learningClasses = LearningClass::all();


        return view('discipline.edit', [
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
    public function update(UpdateAcademicDisciplineRequest $request, int $academicDiscipline)
    {
        $academicDiscipline = AcademicDiscipline::find($academicDiscipline); //!!!!!!!!!!!!!!

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


        return AcademicDisciplineController::index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $academicDiscipline)
    {

        $academicDiscipline = AcademicDiscipline::find($academicDiscipline); //!!!!!!!!!!!!!!
        $academicDiscipline->users()->sync(array()); //костыль
        $academicDiscipline->learningClasses()->sync(array()); //костыль
        $academicDiscipline->delete();
        return AcademicDisciplineController::index();
    }

    public function myDiscipline()
    {
        $disciplines = (auth()->user())->academicDisciplines()->get();


        return view('discipline.teacher.my_discipline', ['disciplines' => $disciplines]);
    }

    public function myDisciplineClasses(AcademicDiscipline $discipline)
    {

        $learningClasses = $discipline->learningClasses()->get();

        return view('discipline.teacher.my_discipline_classes', ['learningClasses' => $learningClasses, 'discipline' => $discipline]);
    }

    public function myDisciplineClassStudents(AcademicDiscipline $discipline, LearningClass $learningClass)
    {

        $students = $learningClass->users()->get();

        return view('discipline.teacher.my_discipline_class_students', ['students' => $students, 'discipline' => $discipline, 'learningClass' => $learningClass]);
    }

    public function myDisciplineStudent(AcademicDiscipline $discipline, LearningClass $learningClass)
    {

        $disciplines = auth()->user()->learningClasses()->first()->academicDisciplines()->get();

        return view('discipline.student.my_discipline_student', ['disciplines' => $disciplines,]);
    }
}
