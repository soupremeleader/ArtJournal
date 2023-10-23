<?php

namespace App\Http\Controllers;

use App\Models\Page;
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
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $id = Auth::id();

        $tags = Page::join('page_tags', 'page_tags.page_id', '=', 'pages.id')
            ->join('tags', 'tags.id', '=', 'page_tags.tag_id')
            ->where('pages.user_id', '=', $id)
            ->select('pages.*', 'tags.*')
            ->get();
        return view('home')->with('tags', $tags)->with('filter');
    }

    public function show(Request $request) {
        $id = Auth::id();

        $tags = Page::join('page_tags', 'page_tags.page_id', '=', 'pages.id')
            ->join('tags', 'tags.id', '=', 'page_tags.tag_id')
            ->join('text_blocks', 'text_blocks.page_id', '=', 'pages.id')
            ->where('pages.user_id', '=', $id)
            ->where('pages.name', 'like', '%'.$request->filterInput.'%')
            ->orwhere('tags.tag_name', 'like', '%'.$request->filterInput.'%')
            ->orwhere('text_blocks.content', 'like', '%'.$request->filterInput.'%')
            ->select('pages.*', 'tags.*')
            ->get();
//        dd($tags);

        return view('home')->with('filter', $request->filterInput)->with('tags', $tags);
    }
}
