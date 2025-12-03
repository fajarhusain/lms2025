<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('operator')->user();
        $students = Student::with('classroom')->get();
        return view(
            'operator::student.index',

            compact(
                'students',
                'user'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::guard('operator')->user();
        $classrooms = Classroom::all();
        return view(
            'operator::student.create',
            compact(
                'classrooms',
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
            'nis' => 'required|string|max:20|unique:students,nis',
            'nisn' => 'required|string|max:20|unique:students,nisn',
            'full_name' => 'required|string|max:255',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'gender' => 'nullable|in:L,P',
            'date_of_birth' => 'nullable|date',
            'place_of_birth' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'emergency_contact' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255|unique:students,email',
            'religion' => 'nullable|string|max:50',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profilePicture = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        Student::create([
            'nis' => $request->input('nis'),
            'nisn' => $request->input('nisn'),
            'full_name' => $request->input('full_name'),
            'classroom_id' => $request->input('classroom_id'),
            'gender' => $request->input('gender'),
            'date_of_birth' => $request->input('date_of_birth'),
            'place_of_birth' => $request->input('place_of_birth'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'province' => $request->input('province'),
            'postal_code' => $request->input('postal_code'),
            'country' => $request->input('country'),
            'phone_number' => $request->input('phone_number'),
            'emergency_contact' => $request->input('emergency_contact'),
            'email' => $request->input('email'),
            'religion' => $request->input('religion'),
            'profile_picture' => $profilePicture,
            'password' => bcrypt($request->input('nisn')),
            'role' => 'student',
        ]);

        return redirect()->route('operator.students.index')->with('success', 'Data Siswa berhasil disimpan.');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new StudentsImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data siswa berhasil diimpor.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $user = Auth::guard('operator')->user();
        $student->load('classroom');
        return view(
            'operator::student.show',

            compact(
                'student',
                'user',
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student, $id)
    {
        $user = Auth::guard('operator')->user();
        $student = Student::with('classroom')->findOrFail($id);
        $classrooms = Classroom::all();
        return view('operator::student.edit',

        compact(
            'student',
            'user',
            'classrooms',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student, $id)
    {
        $request->validate([
            'nis' => 'required|string|max:20|unique:students,nis,' . $id,
            'nisn' => 'required|string|max:20|unique:students,nisn,' . $id,
            'full_name' => 'required|string|max:255',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'gender' => 'nullable|in:L,P',
            'date_of_birth' => 'nullable|date',
            'place_of_birth' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'emergency_contact' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255|unique:students,email,' . $id,
            'religion' => 'nullable|string|max:50',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $student = Student::findOrFail($id);

        $student->nis = $request->input('nis');
        $student->nisn = $request->input('nisn');
        $student->full_name = $request->input('full_name');
        $student->classroom_id = $request->input('classroom_id');
        $student->gender = $request->input('gender');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->place_of_birth = $request->input('place_of_birth');
        $student->address = $request->input('address');
        $student->city = $request->input('city');
        $student->province = $request->input('province');
        $student->postal_code = $request->input('postal_code');
        $student->country = $request->input('country');
        $student->phone_number = $request->input('phone_number');
        $student->emergency_contact = $request->input('emergency_contact');
        $student->email = $request->input('email');
        $student->religion = $request->input('religion');
        $student->password = bcrypt($request->input('nisn'));

        if ($request->hasFile('profile_picture')) {
            if ($student->profile_picture) {
                Storage::disk('public')->delete($student->profile_picture);
            }

            $student->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $student->save();

        return redirect()->route('operator.students.index')->with('success', 'Data Siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student, $id)
    {
        $student = Student::findOrFail($id);

        if ($student->profile_picture) {
            Storage::disk('public')->delete($student->profile_picture);
        }

        $student->delete();

        return redirect()->route('operator.students.index')->with('success', 'Data Siswa berhasil dihapus.');
    }
}
