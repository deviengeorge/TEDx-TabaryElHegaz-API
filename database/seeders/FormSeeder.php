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
            ["name" => "PR Committee", 'end_date' => now()->addDays(15)],
            ["name" => "OC Committee", 'end_date' => now()->addDays(15)],
            ["name" => "IT & Tech Support Committee", 'end_date' => now()->addDays(15)],
            ["name" => "Human Resources Committee", 'end_date' => now()->addDays(15)],
            ["name" => "Coaching Committee", 'end_date' => now()->addDays(15)],
            ["name" => "Marketing Committee", 'end_date' => now()->addDays(15)],
            ["name" => "Photography Committee", 'end_date' => now()->addDays(15)],
            ["name" => "Content Creation Committee", 'end_date' => now()->addDays(15)],
            ["name" => "Graphic Design Committee", 'end_date' => now()->addDays(15)],
            ["name" => "Video Editing Committee", 'end_date' => now()->addDays(15)],
        ]);
    }
}
