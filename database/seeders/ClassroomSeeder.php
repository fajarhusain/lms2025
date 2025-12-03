<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classroom;
use App\Models\User;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher1 = User::where('nip', '197703032003123003')->first();
        $teacher2 = User::where('nip', '197804042004124004')->first();
        $teacher3 = User::where('nip', '197805052005125005')->first();
        $teacher4 = User::where('nip', '197806062006126006')->first();
        $teacher5 = User::where('nip', '197807072007127007')->first();
        $teacher6 = User::where('nip', '197808082008128008')->first();
        $teacher7 = User::where('nip', '197809092009129009')->first();
        $teacher8 = User::where('nip', '197810102010130010')->first();
        $teacher9 = User::where('nip', '197811112011131011')->first();


        // Kelas 10
        Classroom::create([
            'class_code' => 'CLASS10A',
            'class_name' => 'X A',
            'grade_level' => '10',
            'homeroom_teacher_id' => $teacher1->id,
        ]);
        Classroom::create([
            'class_code' => 'CLASS10B',
            'class_name' => 'X B',
            'grade_level' => '10',
            'homeroom_teacher_id' => $teacher2->id,
        ]);
        Classroom::create([
            'class_code' => 'CLASS10C',
            'class_name' => 'X C',
            'grade_level' => '10',
            'homeroom_teacher_id' => $teacher3->id,
        ]);

        // Kelas 11
        Classroom::create([
            'class_code' => 'CLASS11A',
            'class_name' => 'XI A',
            'grade_level' => '11',
            'homeroom_teacher_id' => $teacher4->id,
        ]);
        Classroom::create([
            'class_code' => 'CLASS11B',
            'class_name' => 'XI B',
            'grade_level' => '11',
            'homeroom_teacher_id' => $teacher5->id,
        ]);
        Classroom::create([
            'class_code' => 'CLASS11C',
            'class_name' => 'XI C',
            'grade_level' => '11',
            'homeroom_teacher_id' => $teacher6->id,
        ]);

        // Kelas 12
        Classroom::create([
            'class_code' => 'CLASS12A',
            'class_name' => 'XII A',
            'grade_level' => '12',
            'homeroom_teacher_id' => $teacher7->id,
        ]);
        Classroom::create([
            'class_code' => 'CLASS12B',
            'class_name' => 'XII B',
            'grade_level' => '12',
            'homeroom_teacher_id' => $teacher8->id,
        ]);
        Classroom::create([
            'class_code' => 'CLASS12C',
            'class_name' => 'XII C',
            'grade_level' => '12',
            'homeroom_teacher_id' => $teacher9->id,
        ]);
    }
}
