<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\DepartmentDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\departmentCreate;
use App\Http\Requests\departmentEdit;
use App\Models\Department;
use App\Traits\DepartmentTrait;


class DepartmentController extends Controller
{
    use DepartmentTrait;
    /**
     * Display a listing of the resource.
     *
     * @param DepartmentDatatable $department
     * @return void
     */
    public function departments(DepartmentDatatable $department)
    {
        return $department->render('admin.departments.index');
    }

    public function departmentCreate()
    {
        return view('admin.departments.create');
    }

    public function departmentStore(departmentCreate $request)
    {
        $this->createNewDepartment($request->all());
        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('admin.departments'));
    }

    public function departmentEdit($id)
    {
        $model = Department::findOrFail($id);

        return view('admin.departments.edit', compact('model' ));
    }

    public function departmentUpdate(departmentEdit $request, $id)
    {
        $request['department_id'] = $id;

        $this->editDepartment($request->all());
        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('admin.departments'));
    }


    public function departmentDelete($id)
    {

        $delete = Department::where('id', $id)->delete();

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
