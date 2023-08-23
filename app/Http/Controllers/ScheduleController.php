<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\AcademicDiscipline;
use App\Models\Homework;
use App\Models\LearningClass;
use App\Models\Schedule;
use Dflydev\DotAccessData\Data;
use Illuminate\Foundation\Events\DiscoverEvents;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $learningClasses = LearningClass::with('academicDisciplines')->get();

        $academicDsciplines = AcademicDiscipline::all();

        $daysOfTheWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

        return (view('schedule.create', ['learningClasses' => $learningClasses, 'daysOfTheWeek' => $daysOfTheWeek, 'academicDisciplines' => $academicDsciplines]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        $schedule = Schedule::firstOrCreate(
            [
                'day_of_the_week' => $request->get('day_of_the_week'),
                'learning_class_id' => $request->get('learning_class_id')
            ]
        );

        if (array_key_exists('academic_discipline_id', $request->validated())) {
            foreach ($request->validated()['academic_discipline_id'] as $number => $academicDisciplineId)
                DB::table('schedule_academic_dicipline')->upsert(
                    [
                        'number' => $number + 1,
                        'academic_discipline_id' => $academicDisciplineId,
                        'schedule_id' => $schedule->id,
                    ],
                    ['schedule_id', 'number'],
                    ['academic_discipline_id']
                );
            DB::table('schedule_academic_dicipline')->where('schedule_id', $schedule->id)->where('number', '>', count($request->validated()['academic_discipline_id']))->delete();
        }

        return redirect('schedule/classes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $disciplines = $schedule->learningClass->academicDisciplines;

        return (view('schedule.edit', ['schedule' => $schedule, 'disciplines' => $disciplines]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        if (array_key_exists('academic_discipline_id', $request->validated()))
        {
            foreach ($request->validated()['academic_discipline_id'] as $number => $academicDisciplineId)
                DB::table('schedule_academic_dicipline')->upsert(
                    [
                        'number' => $number + 1,
                        'academic_discipline_id' => $academicDisciplineId,
                        'schedule_id' => $schedule->id,
                    ],
                    ['schedule_id', 'number'],
                    ['academic_discipline_id']
                );
            DB::table('schedule_academic_dicipline')->where('schedule_id', $schedule->id)->where('number', '>', count($request->validated()['academic_discipline_id']))->delete();
        }
        return redirect('schedule/classes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        // soft
        return redirect('schedule/classes');
    }

    public function classes()
    {
        $learningClasses = LearningClass::with(['academicDisciplines', 'users' => function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'teacher');
            });
        }])->get();

        return view('schedule.classes', ['learningClasses' => $learningClasses]);
    }

    public function showClass(LearningClass $learningClass)
    {
        $schedules = $learningClass->schedules()->with(['academicDisciplines'])->get();

        return view('schedule.showClass', ['schedules' => $schedules]);
    }

    public function showDiscipline()
    {
        $schedules = auth()->user()->learningClasses[0]->schedules()->with(['academicDisciplines'])->get();

        return view('schedule.showClass', ['schedules' => $schedules]);
    }
}
