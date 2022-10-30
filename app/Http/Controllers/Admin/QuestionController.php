<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\QuestionDatatable;
use App\Http\Requests\questionCreate;
use App\Http\Requests\questionEdit;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Setting;
use App\Traits\QuestionTrait;



class QuestionController extends Controller
{
    use QuestionTrait;

    /**
     * Display a listing of the resource.
     *
     * @param QuestionDatatable $question
     * @return void
     */
    public function questions(QuestionDatatable $question)
    {
        return $question->render('admin.questions.index');
    }

    public function questionCreate()
    {
        $question_options =Setting::first()->toArray();
        return view('admin.questions.create', compact('question_options' ));
    }

    public function questionStore(questionCreate $request)
    {

        $this->createNewQuestion($request->all());
        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('admin.questions'));
    }

    public function questionEdit($id)
    {
        $model = Question::findOrFail($id);
        $question_options =Setting::first()->toArray();
if($model->type == 'choice'){

}
        return view('admin.questions.edit', compact('model','question_options' ));
    }

    public function questionUpdate(questionEdit $request, $id)
    {
        $request['question_id'] = $id;

        $this->editQuestion($request->all());
        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('admin.questions'));
    }


    public function questionDelete($id)
    {

        $delete = Question::where('id', $id)->delete();

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = trans('company.delete_success');
        } else {
            $success = true;
            $message = trans('company.delete_error');
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

}
