<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\Page;
use App\Models\PageQuestions;
use App\Models\Setting;
use App\Models\Locations;
use App\Models\Tokens;
use App\Models\UsersSurveys;
use App\Models\UsersSurveysDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use DB;

class GeneralController extends Controller
{
    public function getOneSurvey(Request $request)
    {
        $model = Page::where('status', '1')->first();
        return view('welcome', compact('model'));
    }

    public function checkUserEmail(Request $request)
    {
        $email=$request->input('email');
        try {
            $client = new \GuzzleHttp\Client();
            $data=[
                'validemail'      => '1',
                'email'       =>  $email,
            ];
           $response=  $client->request('POST','http://oso.akhnatontrade.com/api/survey_api.php',['form_params'=>$data ,'verify' => false])->getBody()->getContents();
            Log::info($response);
            $user=json_decode($response, true);
        }catch (\Exception $e){
            $catch=$e->getMessage();
            Log::error('check User Email :: '.$email.' ERROR::'.$e->getMessage());
            $user=json_decode($catch, true);
        }
        $model = Page::where('status', '1')->first();
        $getUserServay=UsersSurveys::where('survey_id',$model->id)->where('EMAIL_ADDRESS',$email)->first();
        if(!$getUserServay){
            if(isset($user['status'])&& $user['status']== 200){
                return view('location', compact('model','user','email'));
            }else{
                return view('welcome', [
                    'errorMessageDuration' => $user ?$user['message']:"error in server",
                    'model' => $model,
                ]);
            }
        }else{
            return view('welcome', [
                'errorMessageDuration' => 'You make this survey before thank you',
                'model' => $model,
            ]);
        }

    }

    public function getLocationSurvey(Request $request)
    {

        $EMAIL=$request->input('email');
        $LAST_NAME=$request->input('LAST_NAME');
        $EMPLOYEE_ID=$request->input('EMPLOYEE_ID');
        $location_id=$request->input('location_id');
        $location = Locations::where('id', $location_id)->first();
        $model = Page::where('status', '1')->first();
            if ($model) {



  $page_question_special = PageQuestions::where('page_id', $model->id)
                    ->whereIn('location_id', Locations::select(['id'])->where([
                        ['id', '=', $location_id],
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

  $page_question_general = PageQuestions::where('page_id', $model->id)
                    ->whereIn('location_id', Locations::select(['id'])->where([
                        ['id', '!=', $location_id],
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
//                dd($page_question);
                $question_options = Setting::first()->toArray();
                return view('survey', compact('model', 'page_question', 'question_options','EMAIL','LAST_NAME','EMPLOYEE_ID','location_id'));
        }else{
            return view('welcome', [
            'errorMessageDuration' => 'no Data',
            'model' => null,
          ]);
        }
    }

    public function saveSurvey(Request $request)
    {
        $alldata=$request->all();
        $LAST_NAME=$alldata['LAST_NAME'];
        $EMPLOYEE_ID=$alldata['EMPLOYEE_ID'];
        $EMAIL_ADDRESS=$alldata['EMAIL_ADDRESS'];
        $location_id=$alldata['location_id'];
        $survey_id=$alldata['survey_id'];
        $model = Page::where('status', '1')->first();
        if($LAST_NAME &&$EMPLOYEE_ID&&$EMAIL_ADDRESS&&$EMPLOYEE_ID && $location_id &&$survey_id){
            $users_survey=new UsersSurveys();
            $users_survey->LAST_NAME=$LAST_NAME;
            $users_survey->EMPLOYEE_ID=$EMPLOYEE_ID;
            $users_survey->EMAIL_ADDRESS=$EMAIL_ADDRESS;
            $users_survey->survey_id=$survey_id;
            $users_survey->location_id=$location_id;
            $users_survey->save();
            if($users_survey){
                foreach ($alldata as $key => $value) {
                    if ($key == '_token' || $key == 'LAST_NAME'|| $key == 'EMPLOYEE_ID'|| $key == 'EMAIL_ADDRESS'|| $key == 'location_id'|| $key == 'survey_id') {
                    } else  {
                        if($value == 'option_1' || $value == 'option_2'|| $value == 'option_3'|| $value == 'option_4'|| $value == 'option_5'){
                            $pieces = explode("-", $key);
                            $question_id = $pieces[0];
                            $user_id = $pieces[1];
                            $survey_details=new UsersSurveysDetails();
                            $survey_details->users_surveys_id=$users_survey->id;
                            $survey_details->question_id=$question_id;
                            $survey_details->user_id=$user_id;
                            $survey_details->chose_option=$value;
                            $survey_details->save();
                        }else{
                            $survey_details=new UsersSurveysDetails();
                            $survey_details->users_surveys_id=$users_survey->id;
                            $survey_details->question_id=$key;
                            $survey_details->answer=$value;
                            $survey_details->save();
                        }

                    }
                }
                return view('success', compact('model'));
            }

        }else{

            return view('welcome', [
                'errorMessageDuration' => 'error in Data',
                'model' => $model,
            ]);
        }

    }




}
