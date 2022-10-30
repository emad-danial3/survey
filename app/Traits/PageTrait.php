<?php

namespace App\Traits;

use App\Models\Page;
use Illuminate\Support\Facades\DB;

trait PageTrait
{
    public function createNewPage($request)
    {
        DB::beginTransaction();
        $page = new Page();
        $page->name = $request['name'] ??null;
        $page->location_id = $request['location_id'] ??null;
        $page->save();

        DB::commit();
        $page = Page::find($page->id);
        return $page;
    }

    public function editPage($request)
    {
        DB::beginTransaction();
        $page = Page::findOrFail($request['page_id']);
        $page->name = $request['name'] ??null;
        $page->from_date = $request['date'] ??null;
        $page->to_date = $request['to_date'] ??null;
        $page->save();
        DB::commit();
        $page = Page::find($page->id);
        return $page;
    }
}
