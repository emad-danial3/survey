<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\PolicyDatatable;
use Spatie\Permission\Models\Permission;
use App\Models\Atr_policy;
use Illuminate\Support\Facades\Validator;


class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PolicyDatatable $policy
     * @return void
     */
    public function index(PolicyDatatable $policy)
    {
        return $policy->render('admin.policies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.policies.create');
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
            'departments_id' => 'required',
            'policy_name' => 'required',
            'clause' => 'required',
            'policy_content' => 'required',
            'policy_page' => 'required',
            'policy_path' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $input = $request->all();
        $record = Atr_policy::create($input);
        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('policies.index'));
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
        $model = Atr_policy::findOrFail($id);
        return view('admin.policies.edit', compact('model'));
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

        $this->validate($request, [
            'departments_id' => 'required',
            'clause' => 'required',
            'policy_name' => 'required',
            'policy_content' => 'required',
            'policy_page' => 'required',
            'policy_path' => 'required',
        ]);


        $role = Atr_policy::findOrFail($id);
        $role->departments_id = $request->input('departments_id');
        $role->clause = $request->input('clause');
        $role->policy_name = $request->input('policy_name');
        $role->policy_content = $request->input('policy_content');
        $role->policy_page = $request->input('policy_page');
        $role->policy_path = $request->input('policy_path');
        $role->save();

        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('policies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $delete = Atr_policy::where('id', $id)->delete();

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
