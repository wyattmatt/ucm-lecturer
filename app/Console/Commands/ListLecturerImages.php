<?php

namespace App\Console\Commands;

use App\Models\Lecturer;
use Illuminate\Console\Command;

class ListLecturerImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lecturers:list-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all lecturer images needed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lecturers = Lecturer::orderBy('name')->get();

        $this->info('Total Lecturers: ' . $lecturers->count());
        $this->newLine();

        $this->info('Required Image Files:');
        $this->newLine();

        $table = [];
        foreach ($lecturers as $lecturer) {
            $table[] = [
                'Name' => $lecturer->name,
                'Image File' => $lecturer->image,
                'Room' => $lecturer->room,
                'Departments' => implode(', ', $lecturer->departments),
            ];
        }

        $this->table(
            ['Name', 'Image File', 'Room', 'Departments'],
            $table
        );

        $this->newLine();
        $this->info('Place these images in: public/images/lecturers/');

        return Command::SUCCESS;
    }
}
