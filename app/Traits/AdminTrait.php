<?php

namespace App\Traits;

use App\User;
use Illuminate\Support\Facades\DB;

trait AdminTrait
{
    public function createNewUser($request)
    {
        DB::beginTransaction();
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->mobile = $request['mobile'];
        $user->user_type = 'admin';
        $user->gender = $request['gender'];
        $user->location_id = 0;
        $user->role_id = 2;
        $user->start_date = $request['start_date'];
        $user->end_date = $request['end_date'];
        $user->status = 'active';


        if ($request['image'] != null) {
            $image = $request['image'];
            $image_new_name = time() . '.jpg';
            $image->move('uploads/users', $image_new_name);

            $user->image = 'uploads/users/' . $image_new_name;
        }
        $user->save();

        DB::commit();
        $user = User::find($user->id);
        return $user;
    }
}
