<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Atr_policy;
use Illuminate\Http\Request;

class policiesController extends Controller
{
    private $viewPath;

    public function __construct()
    {
        $this->viewPath = "policies.";
    }

    public function index()
    {
        return view("$this->viewPath.index");
    }

    public function getDirFiles(Request $request): \Illuminate\Http\JsonResponse
    {
        $current_path = $request->get("current_path");

        $this->scanDir($current_path);

        return response()->json(['status' => 200, 'data' => $this->scanDir($current_path)]);

    }

    private function scanDir($current_path): array
    {
        $result = [];

        $path = "polices_doc";

        if ($current_path) {
            $path = $current_path;
        }


        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file) {

            $result[] = [
                "file_name_with_out_extension" => explode(".", $file)[0],
                "file_name"                    => $file,
                "file_path"                    => $path . "/" . $file
            ];
        }

        return $result;
    }

    public function listAllFiles()
    {
        $list_all_files = $this->list_all_files("polices_doc");
        return view($this->viewPath . "list_all_files", [
            "list_all_files" => $list_all_files
        ]);
    }

    public function list_all_files($dir, $files = [])
    {
        $ffs = scandir($dir);

        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);


        if (count($ffs) < 1)
            return $files;

        foreach ($ffs as $ff) {

            if (strpos($ff, '.pdf')) {
                $files[] = [
                    "file_name" => $ff,
                    "file_path" => $dir . "/" . $ff
                ];
                continue;
            }


            if (is_dir($dir . '/' . $ff)) {
                $files = $this->list_all_files($dir . '/' . $ff, $files);
            }
        }

        return $files;

    }

    public function indexingPolicies()
    {
        $atr_policies = Atr_policy::all();

        return view("policies.indexing_files", [
            "atr_policies" => $atr_policies
        ]);
    }


}
