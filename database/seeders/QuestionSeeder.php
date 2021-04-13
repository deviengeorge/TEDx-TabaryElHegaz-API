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
                "title" => "What is Your Full Name?",
                "type" => "text"
            ],
            [
                "title" => "What is Your Phone Number?",
                "type" => "phone"
            ],
            [
                "title" => "What is Your WhatsApp Number?",
                "type" => "phone"
            ],
            [
                "title" => "What is Your Email?",
                "type" => "email"
            ],
            [
                "title" => "What is Your LinkedIn Link? ( optional )",
                "type" => "text"
            ],
            [
                "title" => "What is Your CV? ( optional ) Provide A Link",
                "type" => "text"
            ],
            [
                "title" => "University Or School",
                "type" => "text"
            ],
            [
                "title" => "How did you know about TEDxYouthTabaryEl-HegazHS|Social Media,Friends/Family,Searching,Other",
                "type" => "choose"
            ],
            [
                "title" => "What's the difference between TED and TEDx?",
                "type" => "long_text"
            ],
            [
                "title" => "The Reason of applying for the team",
                "type" => "text"
            ],
            [
                "title" => "What skills that you want to earn by joining",
                "type" => "text"
            ],
            [
                "title" => "What will you add to the team?",
                "type" => "long_text"
            ],
            [
                "title" => "How much time are you willing to dedicate to use?",
                "type" => "text"
            ],
            [
                "title" => "Why Are you applying for TEDxTabaryElHegaz in specific?",
                "type" => "long_text"
            ],
            [
                "title" => "Your Strengths & weaknesses ( Mention 3 for each )",
                "type" => "long_text"
            ],
        ]);
    }
}
