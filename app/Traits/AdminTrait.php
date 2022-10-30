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
        $user->birth_date = $request['birth_date'];
        $user->status = 'active';
        $user->syncRoles($request['roles']);

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
