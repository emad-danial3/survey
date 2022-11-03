<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\Page;
use App\Models\PageQuestions;
use App\Models\Setting;
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
            if($user['status'] == 200){
                if ($model) {
                    $page_question = PageQuestions::where('page_id', $model->id)->with('category')
                        ->with(['category' => function ($query) {
                            $query->with('questions');
                        }])
                        ->with('location')
                        ->with(['users' => function ($query) {
                            $query->with('user');
                        }])->get()->toArray();
                    $question_options = Setting::first()->toArray();
                }

                return view('location', compact('model', 'page_question', 'question_options','user','email'));
            }else{
                return view('welcome', [
                    'errorMessageDuration' => $user['message'],
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
        $model = Page::where('status', '1')->first();
            if ($model) {
                $page_question = PageQuestions::where('page_id', $model->id)->where('location_id',$location_id )->with('category')
                    ->with(['category' => function ($query) {
                        $query->with('questions');
                    }])
                    ->with('location')
                    ->with(['users' => function ($query) {
                        $query->with('user');
                    }])->get()->toArray();
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
                        if($value == 'option_1' || $value == 'option_2'|| $value == 'option_3'|| $value == 'option_4'){
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

    
    
    
    public function checkUserMobileExist(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
        ]);
        $chech = User::where('mobile', '=', $request->mobile)->first();

        $permitted_chars = '0123456789';
        $code = substr(str_shuffle($permitted_chars), 0, 4);
        $chech_mobile = VerificationCode::where('mobile', '=', $request->mobile)->first();
        if (!$chech_mobile) {
            $creat = VerificationCode::create([
                'mobile' => $request->mobile,
                'code' => $code,
                'exp_time' => '2025-09-06',
            ]);
            if (!$chech) {
                return responseJson(200, 'Not Exist', $creat);
            } else {
                return responseJson(400, 'Exist', $creat);
            }
        } else {
            $chech_mobile->code = $code;
            $chech_mobile->save();
            if (!$chech) {
                return responseJson(200, 'Not Exist', $chech_mobile);
            } else {
                return responseJson(400, 'Exist', $chech_mobile);
            }
        }
    }

    public function checkVerificationCode(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'code' => 'required',
        ]);

        $chech = User::where('mobile', '=', $request->mobile)->first();
        $chech_mobile_code = VerificationCode::where('mobile', '=', $request->mobile)->where('code', '=', $request->code)->first();
        if (!$chech) {
            // new user register

            if (!$chech_mobile_code) {
                $data['message'] = "This New User And Fail Code";
                $data['account'] = "new";
                $data['mobile'] = $request->mobile;
                return responseJson(400, 'fail', $data);
            } else {
                $data['message'] = "This New User And Success Code";
                $data['account'] = "new";
                $data['mobile'] = $request->mobile;
                return responseJson(200, 'Success', $data);
            }
        } else {


            if (!$chech_mobile_code) {
                $data['message'] = "This Exist User And Fail Code";
                $data['mobile'] = $request->mobile;
                $data['account'] = "exist";
                return responseJson(400, 'fail', $data);
            } else {
                $success['token'] = $chech->createToken('Token Name')->accessToken;
                $chech['token'] = $success['token'];

                $data['message'] = "This Exist User And Success Code";
                $data['account'] = "exist";
                $data['mobile'] = $request->mobile;
                $data['user'] = $chech;

                return responseJson(200, 'Success', $data);
            }
        }
    }

    public function userSignUp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'birth_date' => 'required',
            'gender' => 'required|in:male,female',
            'mobile' => 'required|unique:users',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $input = $request->all();

        $input['status'] = 'active';
        $input['user_type'] = 'client';
        $user = User::create($input);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . '.jpg';
            $image->move('uploads/users', $image_new_name);

            $user->image = 'uploads/users/' . $image_new_name;
            $user->save();
        }

        $success['token'] = $user->createToken('Token Name')->accessToken;
        $success['name'] = $user->name;
        $user['token'] = $success['token'];
        $user['image'] = $user->image;
        $data['message'] = "create User Success";
        $data['account'] = "exist";
        $data['user'] = $user;

        return responseJson(200, trans('create User Success'), $data);

    }


    public function getUserInfo(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $user = User::find($request['user_id']);

        if ($user != null) {

            $user->rate = $this->calculateUserRate($request['user_id'], "user");
            $user->orders_num = Order::where('user_id', $request['user_id'])->count();
            $user->services_rates = plaseRatings::where('user_id', $request['user_id'])->where('user_type', 'user')->count();
            $user->users_rates = $this->calculateUserRateCount($request['user_id'], "user");
            $user->balance = $this->getMyBalance($request['user_id']);

//
//        "orders_num": 0,
//        "services_rates": 0,
//        "users_rates": 0و


        }

        return responseJson(200, trans('create User Success'), $user);

    }




    public function addImage(Request $request)
    {
        $messages = [
            'file.required' => 'We need  file Image must be image',
        ];
        $validator = Validator::make($request->all(), [
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50048'
        ], $messages);

        if ($validator->fails()) {
            return responseJson(400, 'Fail', $messages);
        }
        if ($request->hasFile('file')) {
            $rr = rand(1, 5000000);
            $image = $request->file;
            $image_new_name = time() . $rr . '.jpg';
            $image->move('uploads/chat', $image_new_name);
            $imagepath = 'uploads/chat/' . $image_new_name;
            $image = ["path" => $imagepath];
            return responseJson(200, trans('Add Image Success'), $image);
        }
    }


}
