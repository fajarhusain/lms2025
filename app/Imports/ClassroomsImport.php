<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ClassroomsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        // Pastikan data lengkap
        if (empty($row['class_code']) || empty($row['class_name']) || empty($row['grade_level']) || empty($row['teacher_code'])) {
            Log::warning("Data kelas tidak lengkap: " . json_encode($row));
            return null;
        }

        // Cek apakah class_code sudah ada
        $existingClass = Classroom::where('class_code', $row['class_code'])->first();
        if ($existingClass) {
            Log::info("Class code {$row['class_code']} sudah ada, dilewati.");
            return null; // Lewatkan record ini
        }

        // Cek teacher
        $teacher = User::where('nip', $row['teacher_code'])->first();
        if (!$teacher) {
            Log::warning("Teacher tidak ditemukan untuk NIP: {$row['teacher_code']}");
            return null;
        }

        return new Classroom([
            'class_code' => $row['class_code'],
            'class_name' => $row['class_name'],
            'grade_level' => $row['grade_level'],
            'homeroom_teacher_id' => $teacher->id,
        ]);
    }
}
