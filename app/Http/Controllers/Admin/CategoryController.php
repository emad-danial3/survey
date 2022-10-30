<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\categoryEdit;
use App\Models\Category;
use App\DataTables\Admin\CategoryDatatable;
use App\DataTables\Admin\UserDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\categoryCreate;
use App\Models\CategoryLang;
use App\Traits\CategoryTrait;
use App\Traits\UserTrait;
use App\User;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CategoryController extends Controller
{
    use CategoryTrait;

    /**
     * Display a listing of the resource.
     *
     * @param CategoryDatatable $category
     * @return void
     */
    public function categories(CategoryDatatable $category)
    {
        return $category->render('admin.categories.index');
    }

    public function categoryCreate()
    {
        return view('admin.categories.create');
    }

    public function categoryStore(categoryCreate $request)
    {
        $this->createNewCategory($request->all());
        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('admin.categories'));
    }

    public function categoryEdit($id)
    {
        $model = Category::findOrFail($id);

        return view('admin.categories.edit', compact('model' ));
    }

    public function categoryUpdate(categoryEdit $request, $id)
    {
        $request['category_id'] = $id;
        if ($request['img'] == null) {
            $request['img'] = null;
        }
        $this->editCategory($request->all());
        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('admin.categories'));
    }


    public function categoryDelete($id)
    {

        $delete = Category::where('id', $id)->delete();

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
