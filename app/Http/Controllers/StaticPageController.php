<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StaticPageController extends Controller
{
    public function craftedByUs(Request $request)
    {
        return view('crafted-by-us', ['user' => $request->user()]);
    }

}
