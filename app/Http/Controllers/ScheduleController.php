<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Models\AcademicDiscipline;
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
        $learningClasses = LearningClass::all();
        $disciplines = AcademicDiscipline::all(); //сделать тут и в блейд что бы менялись относительно дня класса

        $daysOfTheWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

        return (view('schedule.create', ['learningClasses' => $learningClasses, 'disciplines' => $disciplines, 'daysOfTheWeek' => $daysOfTheWeek]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        $schedule = Schedule::firstOrCreate([
            'day_of_the_week' => $request->get('day_of_the_week'),
            'learning_class_id' => $request->get('learning_class_id')
        ]
        );

        if (array_key_exists('academic_discipline_id', $request->validated()))
            foreach ($request['academic_discipline_id'] as $number => $academicDisciplineId)
                DB::table('schedule_academic_dicipline')->upsert(
                    [
                        'number' => $number + 1,
                        'academic_discipline_id' => $academicDisciplineId,
                        'schedule_id' => $schedule->id,
                    ],
                    ['schedule_id', 'number'],
                    ['academic_discipline_id']
                );

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

    public function classes()
    {
        $learningClasses = LearningClass::with(['users' => function ($query) {
            $query->with(['roles']);
        }])->get();

        return view('schedule.classes', ['learningClasses' => $learningClasses]);
    }

    public function showClass(LearningClass $learningClass)
    {
        $schedules = $learningClass->schedules();

        $schedules = $schedules->with(['academicDisciplines'])->get();

        return view('schedule.showClass', ['schedules' => $schedules]);
    }

    public function showDiscipline()
    {
        $schedules = auth()->user()->learningClasses()->get()[0]->schedules();

        $schedules = $schedules->with(['academicDisciplines'])->get();

        return view('schedule.showClass', ['schedules' => $schedules]);
    }

}
