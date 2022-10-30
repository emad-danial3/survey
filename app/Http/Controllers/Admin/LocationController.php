<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\LocationDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\locationCreate;
use App\Http\Requests\locationEdit;
use App\Models\Locations;
use App\Traits\LocationTrait;


class LocationController extends Controller
{

    use LocationTrait;

    /**
     * Display a listing of the resource.
     *
     * @param LocationDatatable $category
     * @return void
     */
    public function locations(LocationDatatable $category)
    {
        return $category->render('admin.locations.index');
    }

    public function locationCreate()
    {
        return view('admin.locations.create');
    }

    public function locationStore(locationCreate $request)
    {
        $this->createNewLocation($request->all());
        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('admin.locations'));
    }

    public function locationEdit($id)
    {
        $model = Locations::findOrFail($id);

        return view('admin.locations.edit', compact('model' ));
    }

    public function locationUpdate(locationEdit $request, $id)
    {
        $request['location_id'] = $id;
        if ($request['img'] == null) {
            $request['img'] = null;
        }
        $this->editLocation($request->all());
        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('admin.locations'));
    }


    public function locationDelete($id)
    {

        $delete = Locations::where('id', $id)->delete();

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
