<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tokens;

use App\Models\Notifications;
use App\User;
use App\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;



class TokensController extends Controller
{

    public  function  setDeviceToken(Request $request){
        $request['lang_code']=$request['lang_code']?$request['lang_code']:"ar";
        $messages = [
            'user_id.required' => 'We need to know your User Id',
            'token.required' => 'We need to know your Device Token',
            'lang_code.required' => 'We need to know your lang_code',
            'type.required' => 'We need to know your Phone system type `android` OR `ios`',
        ];
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'token' => 'required',
            'type' => 'required',
            'lang_code' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return responseJson(400, 'Fail',$messages );
        }


        $check = Tokens::where('user_id', $request['user_id'])->first();
        $checktoken = Tokens::where('token', $request['token'])->first();

        if(!$check&&!$checktoken){
            $token= Tokens::create([
                'user_id' => $request['user_id'],
                'token' => $request['token'],
                'type' => $request['type'],
                'lang_code' => $request['lang_code'],
                'login' => '1',
            ]);
            return responseJson(200, 'Success', $token);
        }
        elseif(!$check&&$checktoken){
            $checktoken->update([
                'login' => '1',
                'user_id' => $request['user_id'],
                'token' => $request['token'],
                'lang_code' => $request['lang_code'],
                'type' => $request['type'],
            ]);
            return responseJson(200, 'Success', $checktoken);
        }elseif($check&&!$checktoken){
            $check->update([
                'login' => '1',
                'user_id' => $request['user_id'],
                'token' => $request['token'],
                'lang_code' => $request['lang_code'],
                'type' => $request['type'],
            ]);
            return responseJson(200, 'Success', $check);
        }

    }

    public  function  updateDevicesLanguage(Request $request){
        $request['lang_code']=$request['lang_code']?$request['lang_code']:"ar";
        $messages = [
            'user_id.required' => 'We need to know your User Id',
            'token.required' => 'We need to know your Device Token',
            'lang_code.required' => 'We need to know your lang_code',
        ];
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'token' => 'required',
            'lang_code' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return responseJson(400, 'Fail',$messages );
        }
        $check = Tokens::where('token', $request['token'])->first();
        if($check){
            $check->update([
                'login' => '1',
                'lang_code' => $request['lang_code'],
            ]);
            return responseJson(200, 'Success', $check);
        }
    }

  public  function  userLogout(Request $request){
        $messages = [
            'user_id.required' => 'We need to know your User Id',
            'token.required' => 'We need to know your Device Token',
        ];
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'token' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return responseJson(400, 'Fail',$messages );
        }
        $check = Tokens::where('token', $request['token'])->first();
        if($check){
            $check->update([
                'login' => '0',
            ]);
            return responseJson(200, 'Success', $check);
        }
    }


public function getMyUserNotifications(Request $request){

    $validator = Validator::make($request->all(), [
        'user_id' => 'required',
    ]);

    if ($validator->fails()) {
        return responseJson(400, $validator->errors()->first(), $validator->errors());
    }

    $notifications = DB::select("SELECT n.*,u.`name` as 'user_name',u.`image` as 'user_image' from `notifications` n 
LEFT JOIN `users` u ON n.`send_user_id` = u.`id`
 WHERE  n.`receive_user_id` ='{$request['user_id']}' AND n.`send_user_id` !='{$request['user_id']}' ORDER BY n.`id` DESC  LIMIT 100 ");

    if($notifications !=null){
        return responseJson(200, 'Success', $notifications);
    }else{
        return responseJson(400, "Notifications Not Found",null );
    }


}


}
