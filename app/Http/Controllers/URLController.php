<?php

namespace App\Http\Controllers;

use App\Models\URL;
use Illuminate\Http\Request;

/**
 * Class URLController
 * @package App\Http\Controllers
 */
class URLController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function create(Request $request)
    {
        $originalURL = $request->input('url');
        $expire = $request->input('expire');

        $url = new URL();
        $url->code = 'TEST';
        $url->url = $originalURL;
        $url->hits = 0;
        $url->save();

        return response()->json(['success' => true], 201);
    }
}
