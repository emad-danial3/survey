<?php

namespace App\Traits;

use App\User;
use Illuminate\Support\Facades\DB;

trait UserTrait
{
    public function createNewUser($request)
    {
        DB::beginTransaction();
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
//        $user->password = bcrypt($request['password']);
        $user->mobile = $request['mobile'];
        $user->user_type = 'worker';
        $user->gender = $request['gender'];
        $user->location_id = $request['location_id'];
        $user->status = 'active';

        if (isset($request->image) && $request->image != null) {
            $image = $request['image'];
            $image_new_name = time() . '.jpg';
            $image->move('uploads/users', $image_new_name);
            $user->image = 'uploads/users/' . $image_new_name;
            $user->save();
        }
        $user->save();
        DB::commit();
        $user = User::find($user->id);
        return $user;
    }
}
