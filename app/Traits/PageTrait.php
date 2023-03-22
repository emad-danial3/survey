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
        $page->option_1_percent = $request['option_1_percent'] ?? 0;
        $page->option_2_percent = $request['option_2_percent'] ?? 0;
        $page->option_3_percent = $request['option_3_percent'] ?? 0;
       
        $page->option_5_percent = $request['option_5_percent'] ?? 0;

        $page->save();
        DB::commit();
        $page = Page::find($page->id);
        return $page;
    }
}
