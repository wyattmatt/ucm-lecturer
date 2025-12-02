<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Open House UCM',
                'image' => 'open_house_ucm.jpg',
                'description' => 'Join us for the University College of Management Open House! Explore our campus, meet faculty members, and discover our diverse programs designed to prepare you for a successful career in management and business.',
                'start_date' => '2025-12-15',
                'start_time' => '09:00:00',
                'end_date' => '2025-12-17',
                'end_time' => '17:00:00',
                'modified_by' => 1,
            ],
            [
                'title' => 'Entrance UC Makassar',
                'image' => 'entrance_uc_makassar.jpg',
                'description' => 'Prepare for success with our Entrance UC Makassar event! Get insights into the admission process, meet current students, and learn about the exciting opportunities that await you at University College Makassar.',
                'start_date' => '2025-12-20',
                'start_time' => '13:00:00',
                'end_date' => '2025-12-20',
                'end_time' => '16:00:00',
                'modified_by' => 1,
            ],
            [
                'title' => 'O-Week UC Makassar',
                'image' => 'oweek_uc_makassar.jpg',
                'description' => 'Welcome to O-Week at University College Makassar! Kickstart your university journey with a week full of exciting activities, orientation sessions, and opportunities to connect with fellow students and faculty members.',
                'start_date' => '2026-01-10',
                'start_time' => '10:00:00',
                'end_date' => '2026-01-10',
                'end_time' => '15:00:00',
                'modified_by' => 2,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
