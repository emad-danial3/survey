<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\categoryEdit;
use App\Http\Requests\pageEdit;
use App\Models\Page;
use App\DataTables\Admin\PageDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\pageCreate;

use App\Models\PageQuestions;
use App\Models\PageQuestionUsers;
use App\Models\Setting;
use App\Traits\PageTrait;
use App\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use PageTrait;

    /**
     * Display a listing of the resource.
     *
     * @param PageDatatable $page
     * @return void
     */
    public function pages(PageDatatable $page)
    {
        return $page->render('admin.pages.index');
    }

    public function pageCreate()
    {
        return view('admin.pages.create');
    }

    public function pageStore(Request $request)
    {
//        $this->createNewPage($request->all());
        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('admin.pages'));
    }

    public function getUsersByLocation(Request $request)
    {
        $users = User::where("location_id", $request->location_id)->where("status", 'active')->get();
        $response = [
            'status' => 200,
            'message' => "All Users",
            'data' => $users
        ];
        return response()->json($response);
    }

    public function addNewUser(Request $request)
    {
        // add new user

        $page_question = PageQuestions::where('page_id', $request['page_id'])->where('location_id', $request['location_id'])->where('category_id', $request['category_id'])->first();
        if ($page_question) {
            $page_question_users = new PageQuestionUsers();
            $page_question_users->page_detail_id = $page_question->id;
            $page_question_users->user_id = $request['user_id'];
            $page_question_users->save();
            $response = [
                'status' => 200,
                'message' => "Question Created Success",
                'data' => $page_question
            ];
            return response()->json($response);
        } else {
            if($request['page_id'] && $request['category_id'] && $request['location_id']){
                $page_question = new PageQuestions();
                $page_question->page_id = $request['page_id'];
                $page_question->category_id = $request['category_id'];
                $page_question->location_id = $request['location_id'];
                $page_question->save();
                if ($page_question) {
                    $page_question_users = new PageQuestionUsers();
                    $page_question_users->page_detail_id = $page_question->id;
                    $page_question_users->user_id = $request['user_id'];
                    $page_question_users->save();
                }
                $response = [
                    'status' => 200,
                    'message' => "Question Created Success",
                    'data' => $page_question
                ];
                return response()->json($response);
            }
        }
        $response = [
            'status' => 404,
            'message' => "error not found",
            'data' => null
        ];
        return response()->json($response);
    }

    public function saveUpdateUser(Request $request)
    {

        $row = PageQuestionUsers::where('page_detail_id', $request->id)->where('user_id', $request->old_user_id)->first();
        if ($row) {
            $row->user_id = $request['user_id'];
            $row->save();
            $response = [
                'status' => 200,
                'message' => "Question Created Success",
                'data' => $row
            ];
            return response()->json($response);
        }
        $response = [
            'status' => 404,
            'message' => "error not found",
            'data' => null
        ];
        return response()->json($response);
    }

    public function deleteCategoryUser(Request $request)
    {

        $delete = PageQuestionUsers::where('page_detail_id', $request->id)->where('user_id', $request->user_id)->delete();
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

    public function addNewQuestion(Request $request)
    {
        if (!isset($request->page_id) || $request->page_id == null) {
            $page = new Page();
            $page->name = $request['main_page_title'];
            $page->from_date = $request['main_page_date'] ?? null;
            $page->to_date = $request['main_page_to_date'] ?? null;
            $page->save();
            if ($page) {
                if($request['category_id'] && $request['location_id']){
                $page_question = new PageQuestions();
                $page_question->page_id = $page->id;
                $page_question->category_id = $request['category_id'];
                $page_question->location_id = $request['location_id'];
                $page_question->save();
                if ($page_question) {
                    $question_users_array = json_decode($request->question_users, true);
                    if ($question_users_array && count($question_users_array) > 0) {
                        foreach ($question_users_array as $key => $user) {
                            if ($user) {
                                $page_question_users = new PageQuestionUsers();
                                $page_question_users->page_detail_id = $page_question->id;
                                $page_question_users->user_id = $user;
                                $page_question_users->save();
                            }
                        }
                    }
                }
                }
            }
            $response = [
                'status' => 200,
                'message' => "Question Created Success",
                'data' => $page
            ];
            return response()->json($response);
        } else {
            $page = Page::findOrFail($request->page_id);
            if ($page) {
                if($request['category_id'] && $request['location_id']){
                $page_question = new PageQuestions();
                $page_question->page_id = $page->id;
                $page_question->category_id = $request['category_id'];
                $page_question->location_id = $request['location_id'];
                $page_question->save();
                if ($page_question) {
                    $question_users_array = json_decode($request->question_users, true);
                    if ($question_users_array && count($question_users_array) > 0) {
                        foreach ($question_users_array as $key => $user) {
                            if ($user) {
                                $page_question_users = new PageQuestionUsers();
                                $page_question_users->page_detail_id = $page_question->id;
                                $page_question_users->user_id = $user;
                                $page_question_users->save();
                            }
                        }
                    }
                }
            }
            }
            $response = [
                'status' => 200,
                'message' => "Question Created Success",
                'data' => $page
            ];
            return response()->json($response);
        }
        $response = [
            'status' => 404,
            'message' => "error",
            'data' => null
        ];
        return response()->json($response);
    }


    public function pageEdit($id)
    {
        $model = Page::findOrFail($id);

        $page_question = PageQuestions::where('page_id', $model->id)->with('category')->with('location')->with(['users' => function ($query) {
            $query->with('user');
        }])->get()->toArray();
//      dd($page_question);
        return view('admin.pages.edit', compact('model', 'page_question'));
    }

    public function pageShow($id)
    {
        $model = Page::findOrFail($id);
        $page_question = PageQuestions::where('page_id', $model->id)->with('category')
            ->with(['category' => function ($query) {
                $query->with('questions');
            }])
            ->with('location')
            ->with(['users' => function ($query) {
                $query->with('user');
            }])->get()->toArray();

        $question_options =Setting::first()->toArray();
//        dd($question_options);
        return view('admin.pages.show', compact('model', 'page_question','question_options'));
    }

    public function pageUpdate(pageEdit $request, $id)
    {
        $request['page_id'] = $id;

        $this->editPage($request->all());
        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('admin.pages'));
    }


    public function pageDuplicate($id)
    {
        $page = Page::find($id);

        // check data deleted or not
        if ($page != null) {
            $page_copy = new Page();
            $page_copy->name = $page->name;
            $page_copy->from_date = $page->from_date;
            $page_copy->to_date = $page->to_date;
            $page_copy->save();
            if ($page_copy) {

                $question_categoris_array = PageQuestions::where('page_id', $page->id)->get();
                if ($question_categoris_array && count($question_categoris_array) > 0) {
                    foreach ($question_categoris_array as $page_q) {
                        if ($page_q) {
                            if($page_q->category_id && $page_q->location_id){
                            $page_question = new PageQuestions();
                            $page_question->page_id = $page_copy->page_id;
                            $page_question->category_id = $page_q->category_id;
                            $page_question->location_id = $page_q->location_id;
                            $page_question->save();

                            $page_users = PageQuestionUsers::where('page_detail_id', $page_q->id)->pluck('user_id');
                            if ($page_users && count($page_users) > 0) {
                                foreach ($page_users as $user) {
                                    $page_question_users = new PageQuestionUsers();
                                    $page_question_users->page_detail_id = $page_question->id;
                                    $page_question_users->user_id = $user;
                                    $page_question_users->save();
                                }
                            }
                        }
                        }
                    }
                }
                $success = true;
                $message = trans('admin.duplicate_success');
            }

        } else {
            $success = false;
            $message = trans('admin.duplicate_error');
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function pageDisabled($id)
    {
        $page = Page::find($id);

        // check data deleted or not
        if ($page != null) {
            $page->status = 0;
            $page->save();

            $success = true;
            $message = trans('admin.disabled_success');
        } else {
            $success = true;
            $message = trans('admin.disabled_error');
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function pageActivated($id)
    {
        $page = Page::find($id);

        // check data deleted or not
        if ($page != null) {
            $page->status = 1;
            $page->save();

            $success = true;
            $message = trans('admin.activated_success');
        } else {
            $success = true;
            $message = trans('admin.activated_error');
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
