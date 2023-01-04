<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AdminDatatable;
use App\DataTables\Admin\UserDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\userCreate;
use App\Http\Requests\adminCreate;
use App\Models\Category;
use App\Models\Department;
use App\Models\Page;
use App\Models\Question;
use App\Traits\AdminTrait;
use App\Traits\UserTrait;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admin = auth()->user();
        $userCount = User::count();
        $surveyCount = Page::count();
        $categoriesCount = Category::count();
        $questionsCount = Question::count();
        $departmentsCount = Department::count();


        return view('admin.dashboard', compact(
            'admin', 'userCount',
                    'surveyCount',
                    'categoriesCount',
                    'questionsCount',
                    'departmentsCount'
        ));
    }

    use AdminTrait;

    /**
     * Display a listing of the resource.
     *
     * @param AdminDatatable $admin
     * @return void
     */
    public function admins(AdminDatatable $admin)
    {
        return $admin->render('admin.admins.index');
    }

    public function adminCreate()
    {
        if (session('lang') === 'en') {
            session()->put('lang', 'en');
            $roles = Role::pluck('role_en','id')->all();
        } elseif (session('lang') === 'ar') {
            session()->put('lang', 'ar');
            $roles = Role::pluck('role_ar','id')->all();
        } else {
            session()->put('lang', 'ar');
            $roles = Role::pluck('role_ar','id')->all();
        }
        return view('admin.admins.create', compact('roles'));
    }

    public function adminStore(adminCreate $request)
    {
        $this->createNewUser($request->all());
        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('admin.admins'));
    }

    public function adminEdit($id)
    {
        $model = User::findOrFail($id);
        $roles = Role::pluck('role_ar','role_en','id')->all();
        $perm = Role::all();
        $userRole = $model->roles->pluck('role_ar','role_en','id')->all();
        return view('admin.admins.edit', compact('model', 'roles', 'userRole', 'perm'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $records = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|confirmed',
            'mobile' => 'required|unique:users,mobile,' . $id,
            'image' => 'nullable',
            'gender' => 'required|in:male,female',
            'roles' => 'required'
        ]);
        
        $records->roles()->sync((array) $request->input('roles'));

        $records->update($request->except('password'));
        if (request()->input('password')) {
            $records->update(['password' => bcrypt($request->password)]);
        }

        if ($request->hasFile('image')) {
            // to get image name $image->getClientOriginalName();
            $image = $request->image;
            $image_new_name = time() . '.jpg';
            $image->move('uploads/admins', $image_new_name);

            $records->image = 'uploads/admins/' . $image_new_name;
            $records->save();
        }
        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('admin.admins'));
    }


    public function adminDelete($id)
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
