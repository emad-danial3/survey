<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDatatable;
use App\DataTables\Admin\UserSurveysDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\userCreate;
use App\Models\Order;
use App\Models\Posts;
use App\Models\UsersSurveys;
use App\Models\PageQuestions;
use App\Models\Setting;
use App\Models\Locations;
use App\Traits\UserTrait;
use App\Models\UsersSurveysDetails;
use App\User;
use App\VerificationCode;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use DB;

class UserSurveysController extends Controller
{
    use UserTrait;
    /**
     * Display a listing of the resource.
     *
     * @param UserSurveysDatatable $user
     * @return void
     */
    public function reports(UserSurveysDatatable $user)
    {
        return $user->render('admin.reports.index');
    }


    public function reportShow($id)
    {
        $model = UsersSurveys::where('id', $id)->with('location')->with('survey')->first();
        $location = Locations::where('id', $model->location_id)->first();
        if ($model) {

            $page_question_special = PageQuestions::where('page_id',  $model->survey_id)
                ->whereIn('location_id', Locations::select(['id'])->where([
                    ['id', '=', $model->location_id],
                    ['location_type', '=', 'special'],
                    ['area', '=', $location->area],
                ]))
                ->with('category')
                ->with(['category' => function ($query) {
                    $query->with('questions');
                }])
                ->with('location')
                ->with(['users' => function ($query) {
                    $query->with('user');
                }])->get()->toArray();

            $page_question_general = PageQuestions::where('page_id', $model->survey_id)
                ->whereIn('location_id', Locations::select(['id'])->where([
                    ['id', '!=', $model->location_id],
                    ['location_type', '=', 'general'],
                    ['area', '=', $location->area],
                ]))
                ->with('category')
                ->with(['category' => function ($query) {
                    $query->with('questions');
                }])
                ->with('location')
                ->with(['users' => function ($query) {
                    $query->with('user');
                }])->get()->toArray();

            $page_question =   array_merge($page_question_special,$page_question_general);

            $question_options = Setting::first()->toArray();
            $UsersSurveysDetails= UsersSurveysDetails::where('users_surveys_id', $model->id)->get();
//            $UsersDetails= $UsersSurveysDetails->toArray();
//dd($UsersDetails);

            return view('admin.reports.show', compact('model', 'page_question', 'question_options','UsersSurveysDetails'));
        } else {
            return view('welcome', [
                'errorMessageDuration' => 'no Data',
                'model' => null,
            ]);
        }
    }



    public function reportDelete($id)
    {
        $delete = UsersSurveys::where('id', $id)->delete();

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
