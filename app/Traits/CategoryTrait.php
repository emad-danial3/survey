<?php

namespace App\Traits;

use App\Models\Category;
use App\Models\CategoryLang;
use App\User;
use Illuminate\Support\Facades\DB;

trait CategoryTrait
{
    public function createNewCategory($request)
    {
        DB::beginTransaction();
        $category = new Category();
        $category->name = $request['name'];
        $category->status = $request['status'];
        if (isset($request->img) && $request->img != null) {
            $img = $request->img;
            $img_new_name = time() . '.jpg';
            $img->move('uploads/categories', $img_new_name);

            $category->img = 'uploads/categories/' . $img_new_name;
        }
        $category->save();


        DB::commit();
        $category = Category::find($category->id);
        return $category;
    }

    public function editCategory($request)
    {
        DB::beginTransaction();
        $category = Category::findOrFail($request['category_id']);

        $category->status =$request['status'];
        $category->name =$request['name'];

        if (isset($request->img) && $request->img != null) {
            $img = $request->img;
            $img_new_name = time() . '.jpg';
            $img->move('uploads/categories', $img_new_name);
            $category->img = 'uploads/categories/' . $img_new_name;
        }

        $category->save();



        DB::commit();
        $category = Category::find($category->id);
        return $category;
    }
}
