<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 'PR Committee',
        // 'OC Committee',
        // 'IT & Tech Support Committee',
        // 'Human Resources Committee',
        // 'Coaching Committee',
        // 'Marketing Committee',
        // 'Photography Committee',
        // 'Content Creation Committee',
        // 'Graphic Design Committee',
        // 'Video Editing Committee',
        Form::insert([
            ["name" => "PR Committee"],
            ["name" => "OC Committee"],
            ["name" => "IT & Tech Support Committee"],
            ["name" => "Human Resources Committee"],
            ["name" => "Coaching Committee"],
            ["name" => "Marketing Committee"],
            ["name" => "Photography Committee"],
            ["name" => "Content Creation Committee"],
            ["name" => "Graphic Design Committee"],
            ["name" => "Video Editing Committee"],
        ]);
    }
}
