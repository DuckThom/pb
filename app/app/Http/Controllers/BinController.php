<?php

namespace App\Http\Controllers;

use File;

/**
 * Class BinController
 * @package App\Http\Controllers
 */
class BinController extends Controller
{

    /**
     * Show a paste
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $path = storage_path("code/{$slug}/index.txt");

        if (File::exists($path)) {
            $code = File::get($path);

            return view('paste.show', [
                'code' => $code
            ]);
        } else {
            abort(404, "Paste not found");
        }
    }

}
