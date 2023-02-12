<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Klass; 

class classSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Klass::create([
            'class_name' => 'jss 1'
        ]);

        Klass::create([
            'class_name' => 'jss 2'
        ]);

        Klass::create([
            'class_name' => 'jss 3'
        ]);

        Klass::create([
            'class_name' => 'sss 1'
        ]);

        Klass::create([
            'class_name' => 'sss 2'
        ]);

        Klass::create([
            'class_name' => 'sss 3'
        ]);

    }
}
