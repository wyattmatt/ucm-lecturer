<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecturers = [
            [
                'name' => 'Dr. Budi Santoso',
                'title' => 'Dr., S.Kom., M.Kom.',
                'room' => '301',
                'departments' => ['Informatics'],
                'image' => 'budi_santoso',
                'image_type' => 'jpg',
                'image_size' => '145KB',
            ],
            [
                'name' => 'Prof. Siti Nurhaliza',
                'title' => 'Prof., S.E., M.M.',
                'room' => '205',
                'departments' => ['Management', 'Magister Management'],
                'image' => 'siti_nurhaliza',
                'image_type' => 'png',
                'image_size' => '198KB',
            ],
            [
                'name' => 'Ir. Ahmad Wijaya',
                'title' => 'Ir., M.T.',
                'room' => '402',
                'departments' => ['Informatics'],
                'image' => 'ahmad_wijaya',
                'image_type' => 'jpg',
                'image_size' => '156KB',
            ],
            [
                'name' => 'Dr. Maya Kusuma',
                'title' => 'Dr., S.Ds., M.Ds.',
                'room' => '315',
                'departments' => ['Visual Communication Design'],
                'image' => 'maya_kusuma',
                'image_type' => 'png',
                'image_size' => '187KB',
            ],
            [
                'name' => 'Andi Pratama',
                'title' => 'S.Kom., M.Kom.',
                'room' => '208',
                'departments' => ['Informatics'],
                'image' => 'andi_pratama',
                'image_type' => 'jpg',
                'image_size' => '124KB',
            ],
            [
                'name' => 'Dr. Dewi Lestari',
                'title' => 'Dr., S.E., M.M.',
                'room' => '410',
                'departments' => ['Management'],
                'image' => 'dewi_lestari',
                'image_type' => 'png',
                'image_size' => '165KB',
            ],
            [
                'name' => 'Prof. Rudi Hermawan',
                'title' => 'Prof., S.T., M.T.',
                'room' => '501',
                'departments' => ['Informatics', 'Magister Management'],
                'image' => 'rudi_hermawan',
                'image_type' => 'jpg',
                'image_size' => '210KB',
            ],
            [
                'name' => 'Linda Susanti',
                'title' => 'S.Ds., M.Ds.',
                'room' => '318',
                'departments' => ['Visual Communication Design'],
                'image' => 'linda_susanti',
                'image_type' => 'png',
                'image_size' => '142KB',
            ],
            [
                'name' => 'Dr. Hendra Gunawan',
                'title' => 'Dr., S.Kom., M.T.',
                'room' => '225',
                'departments' => ['Informatics'],
                'image' => 'hendra_gunawan',
                'image_type' => 'jpg',
                'image_size' => '178KB',
            ],
            [
                'name' => 'Rina Marlina',
                'title' => 'S.E., M.M.',
                'room' => '312',
                'departments' => ['Management', 'Magister Management'],
                'image' => 'rina_marlina',
                'image_type' => 'png',
                'image_size' => '133KB',
            ],
            [
                'name' => 'Ir. Bambang Setiawan',
                'title' => 'Ir., M.Sc.',
                'room' => '405',
                'departments' => ['Informatics'],
                'image' => 'bambang_setiawan',
                'image_type' => 'jpg',
                'image_size' => '195KB',
            ],
            [
                'name' => 'Dr. Fitri Handayani',
                'title' => 'Dr., S.Ds., M.Ds.',
                'room' => '320',
                'departments' => ['Visual Communication Design'],
                'image' => 'fitri_handayani',
                'image_type' => 'png',
                'image_size' => '152KB',
            ],
        ];

        foreach ($lecturers as $lecturer) {
            Lecturer::create($lecturer);
        }

        Lecturer::factory(8)->create();
    }
}
