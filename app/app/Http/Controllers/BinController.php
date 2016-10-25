<?php

namespace App\Http\Controllers;

use App\Paste;
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
        $paste = Paste::findBySlug($slug);

        if (!File::exists($path) && $paste === null) {
            return abort(404, "Paste not found");
        }

        if (!$paste && File::exists($path)) {
            $code = File::get($path);

            $paste = new Paste;
            $paste->slug = $slug;
            $paste->content = $code;
            $paste->creator = 'anonymous';
            $paste->save();
        }

        return view('paste.show', [
            'paste' => $paste
        ]);
    }

}
