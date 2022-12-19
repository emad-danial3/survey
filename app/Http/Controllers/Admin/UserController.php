<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\userCreate;
use App\Models\Order;
use App\Models\PageQuestions;
use App\Models\Posts;
use App\Models\Page;
use App\Models\UsersSurveys;
use App\Traits\UserTrait;
use App\User;
use App\Models\Setting;
use App\Models\Locations;
use App\VerificationCode;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use DB;
class UserController extends Controller
{
    use UserTrait;

    /**
     * Display a listing of the resource.
     *
     * @param UserDatatable $user
     * @return void
     */
    public function users(UserDatatable $user)
    {
        return $user->render('admin.users.index');
    }

    public function userCreate()
    {
        return view('admin.users.create');
    }
    public function userPosts($id)
    {
        $orders = Posts::query()->select('posts.*')->get();
//dd($orders);
        return view('admin.users.posts',compact('orders'));
    }
    public function userSurveys($id)
    {
        $user = User::findOrFail($id);
        $location = Locations::find($user->location_id);
        $surveys = Page::all();
        $lastSurveyId='';
        $lastSurveyId = Page::where('status', '1')->first()->id;
        $lastSurvey = Page::where('status', '1')->first();
        $question_options =Setting::first()->toArray();
        $usersMakeSurveyQuestions = DB::table('category_questions')
            ->leftJoin('users_surveys_details', 'category_questions.id', '=', 'users_surveys_details.question_id')
            ->leftJoin('users_surveys', 'users_surveys.id', '=', 'users_surveys_details.users_surveys_id')
            ->where('users_surveys.survey_id', $lastSurveyId)
            ->where('users_surveys_details.user_id', $id)
            ->groupBy('users_surveys_details.question_id')
            ->select('users_surveys_details.question_id','category_questions.title',DB::raw("count(users_surveys_details.id) AS  total_count"),DB::raw("count(IF(users_surveys_details.chose_option='option_1',1,null)) AS  option_1_count"),DB::raw("count(IF(users_surveys_details.chose_option='option_2',1,null)) AS  option_2_count"),DB::raw("count(IF(users_surveys_details.chose_option='option_3',1,null)) AS  option_3_count"),DB::raw("count(IF(users_surveys_details.chose_option='option_4',1,null)) AS  option_4_count"))
            ->get();

        $sum_option_1_count=0;
        $sum_option_2_count=0;
        $sum_option_3_count=0;
        $sum_option_4_count=0;
        $total_sum_percentage=0;
        for($i = 0;$i <count($usersMakeSurveyQuestions);$i++)
        {
           $usersMakeSurveyQuestions[$i]->total_option_1_percent=($lastSurvey->option_1_percent*$usersMakeSurveyQuestions[$i]->option_1_count);
           $usersMakeSurveyQuestions[$i]->total_option_2_percent=($lastSurvey->option_2_percent*$usersMakeSurveyQuestions[$i]->option_2_count);
           $usersMakeSurveyQuestions[$i]->total_option_3_percent=($lastSurvey->option_3_percent*$usersMakeSurveyQuestions[$i]->option_3_count);
           $usersMakeSurveyQuestions[$i]->total_option_4_percent=($lastSurvey->option_4_percent*$usersMakeSurveyQuestions[$i]->option_4_count);
           $usersMakeSurveyQuestions[$i]->total_percentage=(($usersMakeSurveyQuestions[$i]->total_option_1_percent + $usersMakeSurveyQuestions[$i]->total_option_2_percent+$usersMakeSurveyQuestions[$i]->total_option_3_percent+$usersMakeSurveyQuestions[$i]->total_option_4_percent)/($usersMakeSurveyQuestions[$i]->total_count));
           $usersMakeSurveyQuestions[$i]->total_percentage= round( $usersMakeSurveyQuestions[$i]->total_percentage, 2);
            $sum_option_1_count +=$usersMakeSurveyQuestions[$i]->option_1_count;
            $sum_option_2_count +=$usersMakeSurveyQuestions[$i]->option_2_count;
            $sum_option_3_count +=$usersMakeSurveyQuestions[$i]->option_3_count;
            $sum_option_4_count +=$usersMakeSurveyQuestions[$i]->option_4_count;
            $total_sum_percentage+=$usersMakeSurveyQuestions[$i]->total_percentage;
        }
        $final_total_sum_percentage=count($usersMakeSurveyQuestions) > 0 ?($total_sum_percentage/count($usersMakeSurveyQuestions)):0;
        $final_total_sum_percentage=round($final_total_sum_percentage, 2);
//            ->where('users_surveys.location_id', $user->location_id)
//        dd($usersMakeSurveyQuestions->toArray());

        return view('admin.users.surveys',compact('user','location','surveys','lastSurveyId','usersMakeSurveyQuestions','question_options','sum_option_1_count','sum_option_2_count','sum_option_3_count','sum_option_4_count','final_total_sum_percentage'));
    }
    public function getUserStatistic(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));
        $surveys = Page::all();
        $location = Locations::find($user->location_id);

        $lastSurveyId = $request->input('page_id');
        $lastSurvey = Page::where('id', $request->input('page_id'))->first();
        $question_options =Setting::first()->toArray();
        $usersMakeSurveyQuestions = DB::table('category_questions')
            ->leftJoin('users_surveys_details', 'category_questions.id', '=', 'users_surveys_details.question_id')
            ->leftJoin('users_surveys', 'users_surveys.id', '=', 'users_surveys_details.users_surveys_id')
            ->where('users_surveys.survey_id', $lastSurveyId)

            ->where('users_surveys_details.user_id', $request->input('user_id'))
            ->groupBy('users_surveys_details.question_id')
            ->select('users_surveys_details.question_id','category_questions.title',DB::raw("count(IF(users_surveys_details.chose_option !='option_4',1,null)) AS  total_count"),DB::raw("count(IF(users_surveys_details.chose_option='option_1',1,null)) AS  option_1_count"),DB::raw("count(IF(users_surveys_details.chose_option='option_2',1,null)) AS  option_2_count"),DB::raw("count(IF(users_surveys_details.chose_option='option_3',1,null)) AS  option_3_count"),DB::raw("count(IF(users_surveys_details.chose_option='option_4',1,null)) AS  option_4_count"))
            ->get();

        $sum_option_1_count=0;
        $sum_option_2_count=0;
        $sum_option_3_count=0;
        $sum_option_4_count=0;
        $total_sum_percentage=0;
        for($i = 0;$i <count($usersMakeSurveyQuestions);$i++)
        {
            $usersMakeSurveyQuestions[$i]->total_option_1_percent=($lastSurvey->option_1_percent*$usersMakeSurveyQuestions[$i]->option_1_count);
            $usersMakeSurveyQuestions[$i]->total_option_2_percent=($lastSurvey->option_2_percent*$usersMakeSurveyQuestions[$i]->option_2_count);
            $usersMakeSurveyQuestions[$i]->total_option_3_percent=($lastSurvey->option_3_percent*$usersMakeSurveyQuestions[$i]->option_3_count);
            $usersMakeSurveyQuestions[$i]->total_option_4_percent=($lastSurvey->option_4_percent*$usersMakeSurveyQuestions[$i]->option_4_count);
            $usersMakeSurveyQuestions[$i]->total_percentage=(($usersMakeSurveyQuestions[$i]->total_option_1_percent + $usersMakeSurveyQuestions[$i]->total_option_2_percent+$usersMakeSurveyQuestions[$i]->total_option_3_percent)/(($usersMakeSurveyQuestions[$i]->total_count)));
            $usersMakeSurveyQuestions[$i]->total_percentage= round( $usersMakeSurveyQuestions[$i]->total_percentage, 2);
            $sum_option_1_count +=$usersMakeSurveyQuestions[$i]->option_1_count;
            $sum_option_2_count +=$usersMakeSurveyQuestions[$i]->option_2_count;
            $sum_option_3_count +=$usersMakeSurveyQuestions[$i]->option_3_count;
            $sum_option_4_count +=$usersMakeSurveyQuestions[$i]->option_4_count;
            $total_sum_percentage+=$usersMakeSurveyQuestions[$i]->total_percentage;
        }
        $final_total_sum_percentage=count($usersMakeSurveyQuestions) > 0 ?($total_sum_percentage/(count($usersMakeSurveyQuestions))):0;
        $final_total_sum_percentage=round($final_total_sum_percentage, 2);
//            ->where('users_surveys.location_id', $user->location_id)
//        dd($usersMakeSurveyQuestions->toArray());

        return view('admin.users.surveys',compact('user','location','surveys','lastSurveyId','usersMakeSurveyQuestions','question_options','sum_option_1_count','sum_option_2_count','sum_option_3_count','sum_option_4_count','final_total_sum_percentage'));
    }


    public function userStore(userCreate $request)
    {
        $this->createNewUser($request->all());
        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('admin.users'));
    }

    public function userEdit($id)
    {
        $model = User::findOrFail($id);
        return view('admin.users.edit', compact('model'));
    }

    public function userUpdate(Request $request, $id)
    {
        $records = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'location_id' => 'required',
            'image' => 'nullable',
            'gender' => 'required|in:male,female',
        ]);


        if($records->location_id == $request->location_id){
            $records->update($request->except('password'));
            if (request()->input('password')) {
                $records->update(['password' => bcrypt($request->password)]);
            }
            if ($request->hasFile('image')) {
                // to get image name $image->getClientOriginalName();
                $image = $request->image;
                $image_new_name = time() . '.jpg';
                $image->move('uploads/users', $image_new_name);
                $records->image = 'uploads/users/' . $image_new_name;
                $records->save();
            }
        }else{
            $records->status = 'disactive';
            $records->save();
            $this->createNewUser($request->all());
        }

        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('admin.users'));
    }


    public function userDelete($id)
    {
        $delete = User::where('id', $id)->delete();

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
