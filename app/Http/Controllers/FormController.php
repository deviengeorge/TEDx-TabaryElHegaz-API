<?php

namespace App\Http\Controllers;

use App\Http\Resources\FormResource;
use App\Models\Answer;
use App\Models\Applicant;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class FormController extends Controller
{

    public function showAll()
    {
        return Form::all();
    }

    public function showForm(Form $form)
    {
        return new FormResource(
            Form::query()
                ->where("id", $form->id)
                ->with(["questions", "requirements", "responsibilities"])
                ->first()
        );
    }

    public function createForm(Request $request)
    {
        $form = Form::create([
            'name' => $request->input("name"),
            'end_date' => now()->addDays(15) // default to 15 days after creating the form
        ]);

        // Add the Fixed Questions IDs to the New Form
        $form->questions()->attach([1, 2, 3, 4, 5]);
        $form->responsibilities()->createMany([
            ["content" => "Participate in Website and Applications"],
            ["content" => "Help with any technical issues with the team members"],
            ["content" => "Bla Bla Bla"],
            ["content" => "Bla Bla Bla"]
        ]);
        $form->requirements()->createMany([
            ["content" => "Have an experience with programming"],
            ["content" => "Can deal with problems solving and design patterns"],
            ["content" => "Familiar with database"],
            ["content" => "Knows About Flutter"]
        ]);

        return response(["message" => "Successfully Created A Form"], 201);
    }

    public function showApplicant(Form $form, $id)
    {
        $answers = Answer::query()->where("applicant_id", $id)->get();
        $questions = $form->questions()->get();
        return response(["answers" => $answers, "questions" => $questions], 200);
    }

    public function showApplicants(Form $form)
    {
        $applicants = Applicant::query()->where("form_id", $form->id)->with('answers')->get();
        $questions = $form->questions()->get();
        return response(["applicants" => $applicants, "questions" => $questions], 200);
    }


    public function addQuestion(Request $request, Form $form)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'type' => 'required|in:text,long_text,phone,number,email',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 404);
        }

        $form->questions()->create([
            'title' => $request->input('title'),
            'type' => $request->input('type')
        ]);
        return response(["message" => "Question Added Successfully To The $form->name"], 201);
    }

    public function deleteQuestion(Form $form, $id)
    {
        $form->questions()->detach($id);
        return response(["message" => "Deleted Question with $id in $form->name"], 200);
    }


    public function submitAnswers(Request $request, Form $form)
    {
        $rules = [];
        $questions = $form->questions()->get();

        // If The Time excited The End_date for the Form Then...
        if (Carbon::parse($form->end_date)->diffInMinutes(now()) < 0) {
            return response(["message" => "Sorry The Form Is Closed Right Now."], 406);
        }

        foreach ($questions as $index => $question) {
            $type = $question['type'];
            $rule = "";

            // Check The Type of The Question Field...
            if ($type == "text" || $type == "long_text") $rule = "required|string|max:500";
            else if ($type == "phone") $rule = "required|string|min:11|max:11";
            else if ($type == "number") $rule = "required|numeric|min:15|max:40";
            else if ($type == "email") $rule = "required|email";
            // Check The Type of The Question Field...

            // Assign The Validation Array
            $rules["answers.$index.answer"] = $rule;
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
        ], 200);
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return response([
            "message" => "Successfully Deleted The Form"
        ], 200);
    }
}
