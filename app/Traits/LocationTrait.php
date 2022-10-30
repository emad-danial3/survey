<?php

namespace App\Traits;

use App\Models\Locations;
use App\User;
use Illuminate\Support\Facades\DB;

trait LocationTrait
{
    public function createNewLocation($request)
    {
        DB::beginTransaction();
        $location = new Locations();
        $location->name = $request['name'];
        $location->status = $request['status'];

        $location->save();


        DB::commit();
        $location = Locations::find($location->id);
        return $location;
    }

    public function editLocation($request)
    {
        DB::beginTransaction();
        $category = Locations::findOrFail($request['location_id']);

        $category->status =$request['status'];
        $category->name =$request['name'];

        $category->save();

        DB::commit();
        $category = Locations::find($category->id);
        return $category;
    }
}
