<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\MoneyTransactions;
use App\Models\Complaints;
use App\Models\Tokens;
use App\User;
use App\UserLocation;
use App\Models\Provider;
use App\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\plaseRatings;
use DB;

class GeneralController extends Controller
{
    public  function  checkUserMobileExist(Request $request){

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
        ]);

        $chech=User::where('mobile','=',$request->mobile)->first();

        $permitted_chars = '0123456789';
        $code = substr(str_shuffle($permitted_chars), 0, 4);
        $chech_mobile=VerificationCode::where('mobile','=',$request->mobile)->first();
        if(!$chech_mobile){
            $creat= VerificationCode::create([
                'mobile' => $request->mobile,
                'code' => $code,
                'exp_time' => '2025-09-06',
            ]);
            if(!$chech){
                return responseJson(200, 'Not Exist', $creat);
            }else{
                return responseJson(400, 'Exist',$creat );
            }
        }else{
            $chech_mobile->code=$code;
            $chech_mobile->save();
            if(!$chech) {
                return responseJson(200, 'Not Exist', $chech_mobile);
            }else{
                return responseJson(400, 'Exist',$chech_mobile );
            }
        }
    }
    public  function  checkVerificationCode(Request $request){

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'code' => 'required',
        ]);

        $chech=User::where('mobile','=',$request->mobile)->first();
        $chech_mobile_code=VerificationCode::where('mobile','=',$request->mobile)->where('code','=',$request->code)->first();
        if(!$chech){
            // new user register

            if(!$chech_mobile_code){
                $data['message']="This New User And Fail Code";
                $data['account']="new";
                $data['mobile']=$request->mobile;
                return responseJson(400, 'fail', $data);
            }else{
                $data['message']="This New User And Success Code";
                $data['account']="new";
                $data['mobile']=$request->mobile;
                return responseJson(200, 'Success', $data);
            }
        }else{


            if(!$chech_mobile_code){
                $data['message']="This Exist User And Fail Code";
                $data['mobile']=$request->mobile;
                $data['account']="exist";
                return responseJson(400, 'fail', $data);
            }else{
                $success['token'] = $chech->createToken('Token Name')->accessToken;
                $chech['token'] = $success['token'];

                $data['message']="This Exist User And Success Code";
                $data['account']="exist";
                $data['mobile']=$request->mobile;
                $data['user']=$chech;

                return responseJson(200, 'Success', $data);
            }
        }
    }
    public  function  userSignUp(Request $request)
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

        if ( $request->hasFile('image')  ) {
            $image = $request->image;
            $image_new_name = time() . '.jpg';
            $image->move('uploads/users', $image_new_name);

            $user->image = 'uploads/users/'.$image_new_name;
            $user->save();
        }

        $success['token'] = $user->createToken('Token Name')->accessToken;
        $success['name'] = $user->name;
        $user['token'] = $success['token'];
        $user['image'] = $user->image;
        $data['message']="create User Success";
        $data['account']="exist";
        $data['user']=$user;

        return responseJson(200, trans('create User Success'), $data);

    }


    public  function  userChangeProfile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'birth_date' => 'required',
            'gender' => 'required|in:male,female',
            'mobile' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $user = User::find($request['user_id']);

        if($user !=null){
            $user->update([
                'name' => $request['name'],
                'birth_date' => $request['birth_date'],
                'gender' => $request['gender'],
                'mobile' => $request['mobile'],
                'email' => $request['email'],
            ]);

            if($user->user_type == 'provider'){
                $provider = Provider::where('user_id',$request['user_id'])->first();
                if($provider !=null) {
                    $provider->update([
                        'mobile' => $request['mobile'],
                    ]);
                }
            }
        }


        if ( $request->hasFile('image')  ) {
            $image = $request->image;
            $image_new_name = time() . '.jpg';
            $image->move('uploads/users', $image_new_name);
            $user->image = 'uploads/users/'.$image_new_name;
            $user->save();
        }

        $success['token'] = $user->createToken('Token Name')->accessToken;
        $success['name'] = $user->name;
        $user['token'] = $success['token'];
        $user['image'] = $user->image;
        $data['message']="update User Success";
        $data['account']="exist";
        $data['user']=$user;

        return responseJson(200, trans('create User Success'), $data);

    }

    public  function  changeNotificationsStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'notifications' => 'required',

        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }
        $user = User::find($request['user_id']);
        $token = Tokens::where('user_id',$request['user_id']);
        if($user !=null){
            $user->update([
                'notifications' => $request['notifications'],
            ]);
        }   if($token !=null){
        $token->update([
                'notifications' => $request['notifications'],
            ]);
        }
        $data['user']=$user;
        return responseJson(200, trans('update User Success'), $data);
    }
  public  function  providerchangeNotificationsStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'notifications' => 'required',

        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $Provider = Provider::where('user_id',$request['user_id'])->first();

        if($Provider !=null){
            $Provider->update([
                'notifications' => $request['notifications'],
            ]);
        }
        $data['provider']=$Provider;
        return responseJson(200, trans('update provider Success'), $data);
    }

    public  function  getUserInfo(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $user = User::find($request['user_id']);

        if($user !=null){

            $user->rate=$this->calculateUserRate($request['user_id'], "user");
            $user->orders_num=Order::where('user_id',$request['user_id'])->count();
            $user->services_rates=plaseRatings::where('user_id',$request['user_id'])->where('user_type','user')->count();
            $user->users_rates=$this->calculateUserRateCount($request['user_id'], "user");
            $user->balance=$this->getMyBalance($request['user_id']);

//
//        "orders_num": 0,
//        "services_rates": 0,
//        "users_rates": 0و




        }

        return responseJson(200, trans('create User Success'), $user);

    }


    public  function  getMyMoneyTransactions(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $usertrans = MoneyTransactions::where("user_id",$request['user_id'])->get();

        if($usertrans !=null){
            return responseJson(200, trans('success'), $usertrans);
        }else{
            return responseJson(200, trans('success'), null);
        }
    }


    public  function  getMyDiscountCodes(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $codes = DB::select("SELECT o.id as order_id,o.discount_code ,o.discount_percenting,o.discount_value from `orders` o 
 WHERE  o.`user_id`='{$request['user_id']}'  AND   o.`discount_code` is not null  AND o.`discount_percenting` is not null AND  o.`discount_code` !='' ");


        if($codes !=null){
            return responseJson(200, trans('codes'), $codes);
        }else{
            return responseJson(200, trans('No Discount Codes'), null);
        }
    }

    public  function  getMyComplaints(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }

        $Complaints = Complaints::where("user_id",$request['user_id'])->get();

        if($Complaints !=null){
            return responseJson(200, trans('Complaints'), $Complaints);
        }else{
            return responseJson(200, trans('Complaints'), null);
        }
    }
    public  function  getUserUsersRates(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }
        $rates = DB::select("SELECT u.name,u.image,ur.rate,ur.comment,ur.reason  
 from `users` u LEFT JOIN `user_ratings` ur ON u.`id` = ur.`user_id` 
 WHERE  ur.`user_rate_id`='{$request['user_id']}' AND ur.`user_type`='driver' ");



        if($rates !=null){
            return responseJson(200, trans('Success'), $rates);
        }else{
            return responseJson(200, trans('Success'), null);
        }
    }

    public  function  getUserServicesRates(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(400, $validator->errors()->first(), $validator->errors());
        }
        $rates = DB::select("SELECT p.img,pl.name,pr.rate,pr.comment,pr.reason  
 from `places` p LEFT JOIN `place_langs` pl ON (p.`id` = pl.`place_id` AND pl.lang_code='ar') 
 LEFT JOIN `plase_ratings` pr ON (p.`id` = pr.`place_id`)
 WHERE  pr.`user_id`='{$request['user_id']}' AND pr.`user_type`='user' ");



        if($rates !=null){
            return responseJson(200, trans('Success'), $rates);
        }else{
            return responseJson(200, trans('Success'), null);
        }
    }


    public  function  getPages(Request $request){

        $request['lang_code']=$request['lang_code']?$request['lang_code']:"ar";
        $messages = [
            'lang_code.required' => 'We need to know your lang_code',
        ];
        $validator = Validator::make($request->all(), [
            'lang_code' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return responseJson(400, 'Fail',$messages );
        }


        $pages = DB::select("SELECT p.*,pl.name,pl.description
 from `pages` p LEFT JOIN `page_langs` pl ON p.`id` = pl.`page_id`  WHERE p.`status`='1' AND pl.`lang_code` = '{$request['lang_code']}' ORDER BY p.id");


        return responseJson(200, 'Success', $pages);
    }
    public  function  getOnePageDetails(Request $request){

        $request['lang_code']=$request['lang_code']?$request['lang_code']:"ar";
        $messages = [
            'lang_code.required' => 'We need to know your lang_code',
            'page_id.required' => "Must Page Id For Details"
        ];
        $validator = Validator::make($request->all(), [
            'lang_code' => 'required',
            'page_id' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return responseJson(400, 'Fail',$messages );
        }


        $pages = DB::select("SELECT p.*,pl.name,pl.description
 from `pages` p LEFT JOIN `page_langs` pl ON p.`id` = pl.`page_id`  WHERE p.`status`='1' AND pl.`lang_code` = '{$request['lang_code']}'  AND p.`id`='{$request['page_id']}'  ORDER BY p.id");


        return responseJson(200, 'Success', $pages);
    }

    public  function  getCarTypes(Request $request){

        $request['lang_code']=$request['lang_code']?$request['lang_code']:"ar";
        $messages = [
            'lang_code.required' => 'We need to know your lang_code',
        ];
        $validator = Validator::make($request->all(), [
            'lang_code' => 'required',

        ],$messages);

        if ($validator->fails()) {
            return responseJson(400, 'Fail',$messages );
        }

        $pages = DB::select("SELECT ct.*,ctl.name,ctl.description
 from `car_types` ct LEFT JOIN `car_type_langs` ctl ON ct.`id` = ctl.`car_type_id`  WHERE ct.`status`='1' AND ctl.`lang_code` = '{$request['lang_code']}'  ORDER BY ct.id");

        foreach($pages as $page){
            if($request['lang_code'] == 'ar'){
     $page->models = DB::select("SELECT  id,name_ar as name from `car_models`  WHERE `car_type_id` = '{$page->id}'");
            }else{
     $page->models = DB::select("SELECT  id,name_en as name from `car_models`  WHERE `car_type_id` = '{$page->id}'");
            }
        }

        return responseJson(200, 'Success', $pages);
    }


    public  function  addRepresentativeRequest(Request $request)
    {

        if($request['id'] && $request['id'] != null &&$request['id'] != '' ){
            $provider = Provider::find($request['id']);
            $provider->status = 'updated';
            $provider->id_image_status = '1';
            $provider->profile_image_status = '1';
            $provider->driving_license_status = '1';
            $provider->car_front_status = '1';
            $provider->car_back_status = '1';

            $provider->save();
        }else{
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'full_name' => 'required',
                'mobile' => 'required|unique:providers',
                'email' => 'required|email|unique:providers',
                'identification_number' => 'required',
                'nationality' => 'required',
                'car_type' => 'required',
                'car_model' => 'required',
                'car_year' => 'required',
                'address' => 'required',

            ]);

            if ($validator->fails()) {
                return responseJson(400, $validator->errors()->first(), $validator->errors());
            }

            $input = $request->all();

            $input['status'] = 'new';
            $provider = Provider::create($input);
        }

        if($provider !=null){
            if ( $request->hasFile('profile_image')  ) {
                $rr=rand(1,5000000);
                $image = $request->profile_image;
                $image_new_name = time() .$rr. '.jpg';
                $image->move('uploads/representative', $image_new_name);
                $provider->profile_image = 'uploads/representative/'.$image_new_name;
            }
            if ( $request->hasFile('id_image')  ) {
                $rr=rand(1,5000000);
                $image = $request->id_image;
                $image_new_name = time().$rr . '.jpg';
                $image->move('uploads/representative', $image_new_name);
                $provider->id_image = 'uploads/representative/'.$image_new_name;
            }
            if ( $request->hasFile('driving_license')  ) {
                $rr=rand(1,5000000);
                $image = $request->driving_license;
                $image_new_name = time().$rr . '.jpg';
                $image->move('uploads/representative', $image_new_name);
                $provider->driving_license = 'uploads/representative/'.$image_new_name;
            }
            if ( $request->hasFile('car_front')  ) {
                $rr=rand(1,5000000);
                $image = $request->car_front;
                $image_new_name = time().$rr . '.jpg';
                $image->move('uploads/representative', $image_new_name);
                $provider->car_front = 'uploads/representative/'.$image_new_name;
            }
            if ( $request->hasFile('car_back')  ) {
                $rr=rand(1,5000000);
                $image = $request->car_back;
                $image_new_name = time().$rr . '.jpg';
                $image->move('uploads/representative', $image_new_name);
                $provider->car_back = 'uploads/representative/'.$image_new_name;
            }
        $provider->save();
        }
        return responseJson(200, trans('create Representative Request Success And Waiting for management review'), $provider);

    }

 public  function  addUserMessage(Request $request)
    {
        $input = $request->all();
        $message = Messages::create($input);
        return responseJson(200, trans('Save Message Success'), $message);
    }

    public  function  getConversationMessage(Request $request)
    {
        $messages=Messages::where('chat_rooms_id','=',$request->chat_rooms_id)->get();
        return responseJson(200, trans('get Messages Success'), $messages);
    }


    public  function  updateDriverLocation(Request $request)
    {
        $driver=UserLocation::where('user_id','=',$request->driver_id)->first();
        if($driver !=null){
            $driver->update([
                    'lat' => $request->lat,
                    'lon' => $request->lon,
                ]);
            return responseJson(200, trans('get driver info Success'), $driver);
        }else{
            $driver2= UserLocation::create([
                'user_id' => $request->driver_id,
                'lat' => $request->lat,
                'lon' =>$request->lon ,
            ]);
            return responseJson(200, trans('get driver info Success'), $driver2);
        }
    }

    public  function  getTrackDriverInfo(Request $request)
    {
        $driver2 = DB::select("SELECT ul.*,u.`full_name`,u.`mobile`,`profile_image`
 from `user_locations` ul LEFT JOIN `providers` u ON ul.`user_id` = u.`user_id`  WHERE ul.`user_id`= '{$request['driver_id']}' limit 1 ");
        return responseJson(200, trans('get driver info Success'), $driver2[0]);
    }

    public  function  addImage(Request $request)
    {
        $messages = [
            'file.required' => 'We need  file Image must be image',
        ];
        $validator = Validator::make($request->all(), [
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50048'
        ],$messages);

        if ($validator->fails()) {
            return responseJson(400, 'Fail',$messages );
        }
        if ( $request->hasFile('file')  ) {
            $rr=rand(1,5000000);
            $image = $request->file;
            $image_new_name = time() .$rr. '.jpg';
            $image->move('uploads/chat', $image_new_name);
            $imagepath= 'uploads/chat/'.$image_new_name;
            $image =["path"=>$imagepath];
            return responseJson(200, trans('Add Image Success'), $image);
        }
    }




    public function getMyBalance($user_id){
        $usertrans = MoneyTransactions::where("user_id",$user_id)->get();
        if($usertrans !=null){
            $addfrommanagement=[];
            $orderreceivedvalue=[];
            $deductmanagementcommission=[];
                foreach ($usertrans as $key => $value) {
                    if ($value['type'] == 'addfrommanagement') {
                        $addfrommanagement[] = $value['value'];
                    }
                    else if ($value['type'] == 'orderreceivedvalue') {
                        $orderreceivedvalue[] = $value['value'];
                    }
                    else if ($value['type'] == 'deductmanagementcommission') {
                        $deductmanagementcommission[] = $value['value'];
                    }
                }
                $total = (array_sum($addfrommanagement)  + array_sum($orderreceivedvalue) - array_sum($deductmanagementcommission) );
                $tota=number_format((float)$total, 2, '.', '') ;
return $tota;
        }else{
            return 0;
        }
    }

    public function calculateUserRate($user_id,$user_type){

        if($user_type == 'user'){
            $rate = DB::table('user_ratings')
                ->where('user_rate_id', $user_id)->where('user_type', 'driver')
                ->avg('rate');
        }else{
            $rate = DB::table('user_ratings')
                ->where('user_rate_id', $user_id)->where('user_type', 'user')
                ->avg('rate');
        }
        if($rate > 0){
            return round(floatval($rate), 2);
        }else{
            return 0;
        }
    }
    public function calculateUserRateCount($user_id,$user_type){

        if($user_type == 'user'){
            $rate = DB::table('user_ratings')
                ->where('user_rate_id', $user_id)->where('user_type', 'driver')
                ->count();
        }else{
            $rate = DB::table('user_ratings')
                ->where('user_rate_id', $user_id)->where('user_type', 'user')
                ->count();
        }
        if($rate > 0){
            return round(floatval($rate), 2);
        }else{
            return 0;
        }
    }
    public function calculateUserBalance($user_id){


        if($user_id > 0){
            $rate = DB::table('user_ratings')
                ->where('user_rate_id', $user_id)->where('user_type', 'driver')
                ->count();
        }

        return responseJson(200, 'Success', $rate);
    }


    public  function  getMyCars(Request $request){

        $request['lang_code']=$request['lang_code']?$request['lang_code']:"ar";
        $messages = [
            'user_id.required' => 'We need to know your User ID',
            'lang_code.required' => 'We need to know your lang_code',
        ];
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'lang_code' => 'required',
        ],$messages);

        if ($validator->fails()) {
            return responseJson(400, 'Fail',$messages );
        }

        $nn='name_'.$request['lang_code'];
        $Cars = DB::select("SELECT p.*,ctl.name as 'car_type',cm.`$nn` as 'car_model'
 from `providers` p LEFT JOIN `car_type_langs` ctl ON p.`car_type` = ctl.`car_type_id` LEFT JOIN `car_models` cm ON p.`car_model` = cm.`id`  WHERE  ctl.`lang_code` = '{$request['lang_code']}'  AND p.`user_id` = '{$request['user_id']}' ORDER BY p.id");

        return responseJson(200, 'Success', $Cars);
    }



}
