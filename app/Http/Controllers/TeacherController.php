<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Imports\TeacherImport;
use Maatwebsite\Excel\Facades\Excel;

// use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('operator')->user();
        $teachers = User::where('role', 'teacher')->get();
        return view(
            'operator::teacher.index',

            compact(
                'teachers',
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
        return view('operator::teacher.create',

        compact(
            'user',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'nullable|unique:users,nip|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'degree' => 'required|string|max:10',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'about' => 'nullable|string',
            'place_of_birth' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:L,P',
            'religion' => 'nullable|string|max:50',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'in:admin,teacher'
        ]);

        $profilePicture = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        User::create([
            'nip' => $request->input('nip'),
            'email' => $request->input('email'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'degree' => $request['degree'],
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'province' => $request->input('province'),
            'postal_code' => $request->input('postal_code'),
            'country' => $request->input('country'),
            'phone_number' => $request->input('phone_number'),
            'about' => $request->input('about'),
            'place_of_birth' => $request->input('place_of_birth'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender' => $request->input('gender'),
            'religion' => $request->input('religion'),
            'profile_picture' => $profilePicture,
            'role' => $request->input('role', 'teacher'),
            'password' => bcrypt($request->input('email')),
        ]);

        return redirect()->route('operator.teachers.index')->with('success', 'Data Guru berhasil disimpan.');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new TeacherImport, $request->file('file'));

        return redirect()->route('operator.teachers.index')->with('success', 'Data guru berhasil diimpor.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $teacher, $id)
    {
        $user = Auth::guard('operator')->user();
        $teacher = User::findOrFail($id);

        return view('operator::teacher.show',

        compact(
            'teacher',
            'user',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $teacher, $id)
    {
        $user = Auth::guard('operator')->user();
        $teacher = User::findOrFail($id);
        return view('operator::teacher.edit',

        compact(
            'teacher',
            'user',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $teacher, $id)
    {
        $request->validate([
            'nip' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'degree' => 'required|string|max:10',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'province' => 'nullable|string',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'nullable|string',
            'phone_number' => 'nullable|string|max:15',
            'about' => 'nullable|string',
            'place_of_birth' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'religion' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:8|confirmed' // validasi password baru
        ]);

        $user = User::findOrFail($id);
        $user->nip = $request->input('nip');
        $user->email = $request->input('email');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->degree = $request->input('degree');
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->province = $request->input('province');
        $user->postal_code = $request->input('postal_code');
        $user->country = $request->input('country');
        $user->phone_number = $request->input('phone_number');
        $user->about = $request->input('about');
        $user->place_of_birth = $request->input('place_of_birth');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->gender = $request->input('gender');
        $user->religion = $request->input('religion');

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user->save();

        return redirect()->route('operator.teachers.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $teacher, $id)
    {
        $teacher = User::find($id);

        if (!$teacher) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }

        if ($teacher->profile_picture && file_exists(storage_path('app/public/' . $teacher->profile_picture))) {
            unlink(storage_path('app/public/' . $teacher->profile_picture));
        }

        $teacher->delete();

        return redirect()->route('operator.teachers.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
