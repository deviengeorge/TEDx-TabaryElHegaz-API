<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::insert([
            [
                "title" => "What is Your Name?",
                "type" => "text"
            ], [
                "title" => "What is Your Email?",
                "type" => "email"
            ], [
                "title" => "What is Your WhatsApp Number?",
                "type" => "phone"
            ], [
                "title" => "What is Your Age?",
                "type" => "number"
            ], [
                "title" => "Describe About Your Self in 100 Word?",
                "type" => "long_text"
            ],
        ]);
    }
}
