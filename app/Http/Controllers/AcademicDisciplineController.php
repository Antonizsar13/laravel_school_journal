<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcademicDisciplineRequest;
use App\Http\Requests\UpdateAcademicDisciplineRequest;
use App\Models\AcademicDiscipline;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AcademicDisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $academicDiscipline = AcademicDiscipline::with('users')->get();

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

        return view('discipline.create', ['teachers' => $teachers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcademicDisciplineRequest $request)
    {

        $newdiscipline = AcademicDiscipline::create($request->validated());
        foreach ($request->validated()['teachers'] as $id) {
            $user = User::find($id);
            $newdiscipline->users()->attach($user);
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

        $teachersDiscipline =$academicDiscipline->users()->get();//все но можно только учителе сделать потом
        
        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        return view('discipline.edit', ['discipline' => $academicDiscipline, 'teachers' => $teachers, 'teachersDiscipline' => $teachersDiscipline   ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicDisciplineRequest $request, int $academicDiscipline)
    {
        $academicDiscipline = AcademicDiscipline::find($academicDiscipline);//!!!!!!!!!!!!!!
        
        $academicDiscipline->fill($request->validated());
        $academicDiscipline->save();
        
        $users = array();
        if(array_key_exists('teachers', $request->validated())){
            
            foreach ($request->validated()['teachers'] as $id) {
                array_push($users, $id);
            }
        }
            $academicDiscipline->users()->sync($users);
        
        return AcademicDisciplineController::index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $academicDiscipline)
    {
        
        $academicDiscipline = AcademicDiscipline::find($academicDiscipline); //!!!!!!!!!!!!!!
        $academicDiscipline->users()->sync(array());//костыль
        $academicDiscipline->delete();
        return AcademicDisciplineController::index();
    }
}
