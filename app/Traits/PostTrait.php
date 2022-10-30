<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts;
use App\Models\PageLang;
use Illuminate\Support\Facades\DB;

trait PostTrait
{
    public function createNewPost($request)
    {
        DB::beginTransaction();
        $user_id = Auth::id();
        $post = new Posts();
        $post->status =$request['status'];
        $post->category_id =$request['category_id'];
        $post->user_id =$user_id;
        $post->title =$request['title'];
        $post->description =$request['description'];

        if ($request['img'] != null) {
            $img = $request['img'];
            $img_new_name = time() . '.jpg';
            $img->move('uploads/posts', $img_new_name);
            $post->img = 'uploads/posts/' . $img_new_name;
        }
        $post->save();


        DB::commit();
        $post = Posts::find($post->id);
        return $post;
    }

    public function editPost($request)
    {
        DB::beginTransaction();
        $user_id = Auth::id();
        $post = Posts::findOrFail($request['post_id']);
        $post->status =$request['status'];
        $post->category_id =$request['category_id'];
        $post->user_id =$user_id;
        $post->title =$request['title'];
        $post->description =$request['description'];

        if ($request['img'] != null) {
            $img = $request['img'];
            $img_new_name = time() . '.jpg';
            $img->move('uploads/posts', $img_new_name);
            $post->img = 'uploads/posts/' . $img_new_name;
        }
        $post->save();


        DB::commit();
        $post = Posts::find($post->id);
        return $post;
    }
}
