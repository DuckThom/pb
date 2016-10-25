<?php

namespace App\Http\Controllers;

use App\Paste;
use File, Validator;
use Illuminate\Http\Request;

/**
 * Class BinController
 * @package App\Http\Controllers
 */
class BinController extends Controller
{

    /**
     * Show editor
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('paste.editor');
    }

    /**
     * Save the paste
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:5'
        ]);

        if ($validator->passes()) {
            $slug = $this->generateSlug(6);

            $paste = new Paste;
            $paste->slug = $slug;
            $paste->content = $request->input('code');
            $paste->creator = 'anonymous';
            $paste->save();

            return response()->json([
                'url' => url($slug)
            ], 200);
        }

        return response()->json([
            'message' => $validator->errors()->first()
        ], 400);
    }

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

    /**
     * Edit a paste
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function fork($slug)
    {
        $paste = Paste::findBySlug($slug);

        if ($paste) {
            return view('paste.editor', [
                'paste' => $paste
            ]);
        } else {
            return abort(404, "Paste not found");
        }
    }

    /**
     * Generate a slug
     *
     * @param  int  $size
     * @return string
     */
    private function generateSlug($size)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!';
        $slug  = '';
        $count = 0;

        // Run until the end of times
        while ($count < $size) {
            $slug .= $chars[rand(0, strlen($chars) - 1)];
            $count++;
        }

        return $slug;
    }

}
