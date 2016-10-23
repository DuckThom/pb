<?php

namespace App\Http\Controllers;

use File;

/**
 * Class BinController.
 */
class BinController extends Controller
{
    /**
     * Show a paste.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $path = storage_path("code/{$slug}/index.txt");

        if (File::exists($path)) {
            $code = File::get($path);
            $lines = explode("\n", $code);

            return view('paste.show', [
                'lines' => $lines,
            ]);
        } else {
            abort(404, 'Paste not found');
        }
    }
}
