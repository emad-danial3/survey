<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\RoleDatatable;
use Spatie\Permission\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RoleDatatable $role
     * @return void
     */
    public function index(RoleDatatable $role)
    {
//        return $role->render('admin.roles.index');
        return $role->render('admin.roles.index');
//        $this->data['permissions'] = Role::where('id', '>', 1)->get();
//        return view('admin.roles.index', $role);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
//        if (session('lang') === 'en') {
//            session()->put('lang', 'en');
//            $permission = Permission::pluck('role_en','id')->all();
//        } elseif (session('lang') === 'ar') {
//            session()->put('lang', 'ar');
//            $permission = Permission::pluck('role_ar','id')->all();
//        } else {
//            session()->put('lang', 'ar');
//            $permission = Permission::pluck('role_ar','id')->all();
//        }


        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'role_ar' => 'required',
            'role_en' => 'required',
            'plan' => 'required|array|min:1',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $input = $request->all();
        $record = Role::create($input);
        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('role.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $model = Role::findOrFail($id);
//        $permissions = Permission::all();

        return view('admin.roles.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $records = Role::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'name_ar' => 'required',
            'permission' => 'required',
        ], [
            'name.required' => trans('validation.nameEnIsRequired'),
            'name_ar.required' => trans('validation.nameArIsRequired'),
            'permission.required' => trans('validation.permissionIsRequired'),
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->name_ar = $request->input('name_ar');
        $role->save();

        $role->syncPermissions($request->input('permission'));


        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $delete = Role::where('id', $id)->delete();

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
