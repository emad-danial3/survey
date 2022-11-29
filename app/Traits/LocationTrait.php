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
        $location->location_type = $request['location_type'];
        $location->area = $request['area'];

        $location->save();


        DB::commit();
        $location = Locations::find($location->id);
        return $location;
    }

    public function editLocation($request)
    {
        DB::beginTransaction();
        $location = Locations::findOrFail($request['location_id']);

        $location->status =$request['status'];
        $location->name =$request['name'];
        $location->location_type =$request['location_type'];
        $location->area =$request['area'];

        $location->save();

        DB::commit();
        $location = Locations::find($location->id);
        return $location;
    }
}
