<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClassroomsImport;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('operator')->user();
        $classrooms = Classroom::with('homeroomTeacher')->get();
        return view(
            'operator::classroom.index',

            compact(
                'classrooms',
                'user',
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::guard('operator')->user();
        $teachers = User::where('role', 'teacher')->get();
        return view(
            'operator::classroom.create',

            compact(
                'teachers',
                'user',
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_code' => 'required|unique:classrooms',
            'class_name' => 'required',
            'grade_level' => 'required',
            'homeroom_teacher_id' => 'required|exists:users,id',
        ]);

        Classroom::create($request->all());

        return redirect()->route('operator.classroom.index')->with('success', 'Classroom created successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new ClassroomsImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data kelas berhasil diimpor!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom, $id)
    {
        $classroom = Classroom::findOrFail($id);

        $classroom->delete();

        return redirect()->route('operator.classroom.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
