<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject; 

class subjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'subject' => 'English Language'
        ]);

        Subject::create([
            'subject' => 'Igbo Language'
        ]);
        Subject::create([
            'subject' => 'Mathematics'
        ]);
        Subject::create([
            'subject' => 'Basic Science'
        ]);
        Subject::create([
            'subject' => 'Christian Religious Studies'
        ]);
        Subject::create([
            'subject' => 'Business Studies'
        ]);
        Subject::create([
            'subject' => 'Prevocational Studies'
        ]);
        Subject::create([
            'subject' => 'New Basic Religion and National Values'
        ]);

        Subject::create([
            'subject' => 'Creative and Cultural Arts'
        ]);
        Subject::create([
            'subject' => 'Computer Studies'
        ]);
        Subject::create([
            'subject' => 'French'
        ]);

    }
}
