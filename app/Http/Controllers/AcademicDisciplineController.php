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

        $academicDiscipline = AcademicDiscipline::all();
        
        return view('discipline.index', ['disciplines' => $academicDiscipline]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $teachers = DB::table('users')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')->where('roles.name', '=', 'teacher')
        ->select('users.*', 'roles.name as role')->get();

        return view('discipline.create', ['teachers' => $teachers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcademicDisciplineRequest $request)
    {
        
        $newdiscipline = AcademicDiscipline::create($request->validated());
        foreach ($request->validated()['teachers'] as $id)
        {
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
    public function edit(AcademicDiscipline $academicDiscipline)
    {   

        $academicDiscipline = AcademicDiscipline::find('1');
        $teachers = DB::table('users')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')->where('roles.name', '=', 'teacher')
        ->select('users.*', 'roles.name as role')->get();

        return view('discipline.edit', ['discipline' => $academicDiscipline,'teachers' => $teachers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicDisciplineRequest $request, AcademicDiscipline $academicDiscipline)
    {
        dd('123');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicDiscipline $academicDiscipline)
    {
        //
    }
}
