<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApplicantResource;
use App\Http\Resources\FormResource;
use App\Models\Answer;
use App\Models\Applicant;
use App\Models\Form;
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
                ->with(["questions", "responsibilities"])
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
        $form->questions()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]);
        $form->responsibilities()->createMany([
            ["content" => "Participate in Website and Applications"],
            ["content" => "Help with any technical issues with the team members"],
            ["content" => "Bla Bla Bla"],
            ["content" => "Bla Bla Bla"]
        ]);


        return response(["message" => "Successfully Created A Form"], 201);
    }

    public function showApplicant(Form $form, $id)
    {
        return new ApplicantResource(
            Applicant::query()
                ->where("id", $id)
                ->first()
        );
    }

    public function showApplicants(Form $form)
    {
        return ApplicantResource::collection(
            Applicant::query()
                ->where("form_id", $form->id)
                ->get()
        );
        // return new ApplicantResource(
        //     Form::query()
        //         ->where("id", $form->id)
        //         ->with(["questions", "applicants"])
        //         ->first()
        // );
    }


    public function addQuestion(Request $request, Form $form)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'type' => 'required|in:text,long_text,phone,number,email,rating,video,choose',
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


    public function submitAnswers(Request $request, $id)
    {
        $rules = [];
        $form = Form::query()->where('id', $id)->with('questions')->first();

        // If The Time excited The End_date for the Form Then...
        if (Carbon::parse($form->end_date)->diffInMinutes(now()) < 0) {
            return response(["message" => "Sorry The Form Is Closed Right Now."], 406);
        }

        foreach ($form->questions as $index => $question) {
            $type = $question['type'];
            $rule = "";

            // Check The Type of The Question Field...
            if ($type == "text" || $type == "long_text") $rule = "required|string|max:500";
            else if ($type == "phone") $rule = "required|string|min:11|max:11";
            else if ($type == "number") $rule = "required|numeric|min:15|max:40";
            else if ($type == "email") $rule = "required|email";
            else if ($type == "rating") $rule = "required|string";
            else if ($type == "choose") $rule = "required|string";
            else if ($type == "video") $rule = "string";

            // Assign The Validation Array
            $rules["answers.$index"] = $rule;
        }

        $validator = Validator::make($request->only("answers"), $rules);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 404);
        }


        $answer = implode("||,||", $request->input("answers"));
        Applicant::create([
            "form_id" => $form->id,
            "answer" => $answer
        ]);
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
