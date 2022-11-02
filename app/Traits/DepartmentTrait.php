<?php

namespace App\Traits;

use App\Models\Department;
use App\Models\Locations;
use App\User;
use Illuminate\Support\Facades\DB;

trait DepartmentTrait
{
    public function createNewDepartment($request)
    {
        DB::beginTransaction();
        $department = new Department();
        $department->name = $request['name'];
        $department->status = $request['status'];

        $department->save();


        DB::commit();
        $department = Department::find($department->id);
        return $department;
    }

    public function editDepartment($request)
    {
        DB::beginTransaction();
        $category = Department::findOrFail($request['department_id']);

        $category->status =$request['status'];
        $category->name =$request['name'];

        $category->save();

        DB::commit();
        $category = Department::find($category->id);
        return $category;
    }
}
