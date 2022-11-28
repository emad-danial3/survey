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
        $surveys = Page::all();
        $lastSurveyId='';
        $lastSurveyId = Page::where('status', '1')->first()->id;
        $usersMakeSurvey=UsersSurveys::where('survey_id',$lastSurveyId)->where('location_id',$user->location_id)->get();
dd($usersMakeSurvey);


        $page_question = PageQuestions::where('page_id', $lastSurveyId)->where('location_id', $user->location_id)->with('category')
            ->with(['category' => function ($query) {
                $query->with('questions');
            }])
            ->with('location')->get()->toArray();
//dd($page_question);
        return view('admin.users.surveys',compact('user','surveys','lastSurveyId'));
    }
    public function getUserStatistic(Request $request)
    {
        dd($request);
        $user = User::findOrFail($id);
        $surveys = Page::all();
        $lastSurveyId=$surveyId;

        $page_question = PageQuestions::where('page_id', $lastSurveyId)->where('location_id', $user->location_id)->with('category')
            ->with(['category' => function ($query) {
                $query->with('questions');
            }])
            ->with('location')->get()->toArray();
//dd($page_question);
        return view('admin.users.surveys',compact('user','surveys','lastSurveyId'));
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
