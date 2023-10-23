<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();

       $tags = DB::table('pages')
           ->join('page_tags', 'page_tags.page_id', '=', 'pages.id')
           ->join('tags', 'tags.id', '=', 'page_tags.tag_id')
           ->where('pages.user_id', '=', $id)
           ->select('pages.*', 'tags.*')
           ->get();
//       dd($tags);
        return view('home')->with('tags', $tags);
    }
}
