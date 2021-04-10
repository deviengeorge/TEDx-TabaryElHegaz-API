<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Applicant;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\Question;
use Illuminate\Http\Request;
use Validator;

class FormController extends Controller
{

    public function showAll()
    {
        return Form::all();
    }

    public function showForm(Request $request, Form $form)
    {
        return Form::query()->where("id", $form->id)->with("questions")->first();
    }

    public function createForm(Request $request)
    {
        $form = Form::create([
            'name' => $request->input("name"),
            'end_date' => now()->addDays(15)
        ]);

        // Add the Fixed Questions to the Form
        $form->questions()->attach([1, 2, 3, 4, 5]);

        return response(["message" => "Successfully Created A Form"], 201);
    }

    public function showApplicant(Form $form, $id)
    {
        $answers = Answer::query()->where("applicant_id", $id)->get();
        // $answers = Applicant::query()->where("form_id", $form->id)->where("id", $id)->with('answers')->first();
        $questions = $form->questions()->get();
        return response(["answers" => $answers, "questions" => $questions], 200);
    }

    public function showApplicants(Form $form)
    {
        $answers = Applicant::query()->where("form_id", $form->id)->with('answers')->get();
        $questions = $form->questions()->get();
        return response(["applicants" => $answers, "questions" => $questions], 200);
    }


    public function addQuestion(Request $request, Form $form)
    {
        $request->validate([
            'title' => 'required|string',
            'type' => 'required',
        ]);

        $form->questions()->create([
            'title' => $request->input('title'),
            'type' => $request->input('type')
        ]);
        return response(["message" => "Question Added Successfully To $form->name"], 201);
    }

    public function deleteQuestion(Request $request, Form $form, $id)
    {
        $form->questions()->detach($id);
        return response(["message" => "Deleted Question with $id in $form->name"], 200);
    }


    public function submitAnswers(Request $request, Form $form)
    {
        $rules = [];
        $questions = $form->questions()->get();
        $index = 0;
        foreach ($questions as $question) {
            // echo $question['title'];
            $rules["answers.$index.answer"] = "required";
            $index++;
        }

        $validator = Validator::make($request->only("answers"), $rules);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 404);
        }

        $applicant = Applicant::create([
            "form_id" => $form->id
        ]);
        $applicant->answers()->createMany($request->input("answers"));
        return response(["message" => "Answers Saved To the $form->name"], 201);
    }

    public function update(Request $request, Form $form)
    {
        $form->update([
            $request->input('name')
        ]);
        return response([
            "message" => "Successfully Updated The Form",
            "form" => $form
        ]);
    }

    public function destroy(Form $form)
    {
        //
    }
}
