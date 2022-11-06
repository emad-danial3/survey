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

    public function userCreate()
    {
        return view('admin.users.create');
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


        if ($records->location_id == $request->location_id) {
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
        } else {
            $records->status = 'disactive';
            $records->save();
            $this->createNewUser($request->all());
        }

        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('admin.users'));
    }

    public function reportShow($id)
    {
        $model = UsersSurveys::where('id', $id)->with('location')->with('survey')->first();
        if ($model) {
            $page_question = PageQuestions::where('page_id', $model->survey_id)->where('location_id', $model->location_id)->with('category')
                ->with(['category' => function ($query) {
                    $query->with('questions');
                }])
                ->with('location')
                ->with(['users' => function ($query) {
                    $query->with('user');
                }])->get()->toArray();
            $question_options = Setting::first()->toArray();
            $UsersSurveysDetails= UsersSurveysDetails::where('users_surveys_id', $model->id)->get();
            $UsersDetails= $UsersSurveysDetails->toArray();
//dd($UsersDetails);
//            foreach($page_question as $key=>$category){
//                foreach($category['category']['questions'] as $ind=>$question){
//           Survey Create         foreach($category['users'] as $induser=>$user){
//                        foreach($UsersDetails as $inser=>$userans){
//                           if($question['id'] == $userans['question_id'] && $user['user_id'] == $userans['user_id'] ){
//                              $ABSWER=$userans['chose_option'];
//                           }
//                            $page_question[$key]['category']['questions'][$ind]['EMAD']='aaAA';
//
//                            dd($page_question);
//                        }
//                    }
//                    
//                }
//            }

//            dd($page_question);
//
//            die();




//dd($page_question);
//            $UsersDetails= $UsersSurveysDetails->toArray();
//            if (in_array(5,$UsersSurveysDetails)){
//                dd("dddd");
//            }else{
//                dd("asdasda");
//            }
            return view('admin.reports.show', compact('model', 'page_question', 'question_options','UsersSurveysDetails'));
        } else {
            return view('welcome', [
                'errorMessageDuration' => 'no Data',
                'model' => null,
            ]);
        }
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
