<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHomeworkRequest;
use App\Models\AcademicDiscipline;
use App\Models\Homework;
use App\Models\LearningClass;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homeworks = Homework::with('learningClass','academicDiscipline')->get();   

        return view('homework.index', ['homeworks' => $homeworks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $learningClasses = LearningClass::all();
        $disciplies = AcademicDiscipline::all();

        // в блейде сделать что бы список предметов менялся относительно выбранного класса и тут убрать дисциплину тогда
        return view('homework.create', ['learningClasses' => $learningClasses, 'disciplines' => $disciplies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHomeworkRequest $request)
    {
        Homework::create($request->validated());

        return redirect('homework');
    }

    /**
     * Display the specified resource.
     */
    public function show(Homework $homework)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Homework $homework)
    {

        $learningClasses = LearningClass::all();
        $disciplies = AcademicDiscipline::all();
        
        // в блейде сделать что бы список предметов менялся относительно выбранного класса и тут убрать дисциплину тогда
        return view('homework.edit', ['homework' => $homework, 'learningClasses' => $learningClasses, 'disciplines' => $disciplies]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreHomeworkRequest $request, Homework $homework)
    {
        $homework->fill($request->validated());
        $homework->save();
        
        return redirect('homework');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Homework $homework)
    {
        $homework->delete();
        return redirect('homework');
    }
}
