<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeacherImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip jika email atau nama kosong
        if (empty($row['email']) || empty($row['nama'])) {
            return null;
        }

        // Skip jika data sudah ada di database (nip atau email)
        if (User::where('nip', $row['nip'])->exists() || User::where('email', $row['email'])->exists()) {
            return null;
        }

        // Split nama menjadi first_name dan last_name
        $nama = explode(' ', $row['nama'], 2);
        $first_name = $nama[0];
        $last_name = $nama[1] ?? null;

        // Konversi tanggal lahir
        $date_of_birth = null;
        if (!empty($row['tanggal_lahir'])) {
            if (is_numeric($row['tanggal_lahir'])) {
                $date_of_birth = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir'])->format('Y-m-d');
            } else {
                $date_of_birth = date('Y-m-d', strtotime($row['tanggal_lahir']));
            }
        }

        return new User([
            'nip' => $row['nip'] ?? null,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $row['email'],
            'degree' => $row['gelar'] ?? '-',
            'address' => $row['alamat'] ?? null,
            'place_of_birth' => $row['tempat_lahir'] ?? null,
            'date_of_birth' => $date_of_birth,
            'gender' => ($row['jenis_kelamin'] === 'Laki-laki') ? 'L' : 'P',
            'religion' => $row['agama'] ?? null,
            'password' => bcrypt($row['password'] ?? 'password123'),
            'role' => 'teacher',
        ]);
    }
}
