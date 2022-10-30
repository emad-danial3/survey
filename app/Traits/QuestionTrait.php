<?php

namespace App\Traits;

use App\Models\Question;

use Illuminate\Support\Facades\DB;

trait QuestionTrait
{
    public function createNewQuestion($request)
    {
        DB::beginTransaction();

        $cat_question = new Question();
        $cat_question->category_id=$request['category_id'];
        $cat_question->title=$request['question_title'];
        $cat_question->type=$request['question_type'];
        $cat_question->required=$request['question_required'] == '1'?'1':'0';
        $cat_question->save();

        if($cat_question->type == 'choice'){

        }

        DB::commit();
        $Question = Question::find($cat_question->id);
        return $Question;
    }

    public function editQuestion($request)
    {
        DB::beginTransaction();
        $question = Question::findOrFail($request['question_id']);
        $question->category_id=$request['category_id'];
        $question->title=$request['question_title'];
        $question->type=$request['question_type'];
        $question->required=$request['question_required'] == '1'?'1':'0';
        $question->save();

        if($question->type == 'choice'){

        }
        DB::commit();
        $question = Question::find($question->id);
        return $question;
    }
}
