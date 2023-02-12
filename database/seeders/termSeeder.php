<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Term; 

class termSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Term::create([
            'term' => 'First Term'
        ]);
        Term::create([
            'term' => 'Second Term'
        ]);

        Term::create([
            'term' => 'Third Term'
        ]);
    }
}
