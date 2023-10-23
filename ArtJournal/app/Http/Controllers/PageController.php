<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Tag;
use App\Models\PageTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
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
     * Display a listing of the resource.
     */
    public function index($number) {
        $text_blocks = DB::table('text_blocks')
            ->where('page_id', '=', $number)
            ->get();
        return view('pages', compact('number'))->with('text_blocks', $text_blocks);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $min_page_nr = 0;
        if (DB::table('pages')->min('page_number') !== null) {
            $min_page_nr = DB::table('pages')->min('page_number');
        }
        return view('createPages')->with('potential_title', $min_page_nr + 1);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $user_id = Auth::id();
        $page = new Page;
        $page->name = $request->page_title;
        $min_page_nr = 0;
        if (DB::table('pages')->min('page_number') !== null) {
            $min_page_nr = DB::table('pages')->min('page_number');
        }
        $min_page_nr++;
        $page->page_number = $min_page_nr;
        $page->user_id = $user_id;
        $page->save();

        if(DB::table('tags')
        ->where('tag_name', '=', $request->tags_input)
        ->count() === 0) {
            $tag = new Tag;
            $tag->tag_name = $request->tags_input;
            $tag->save();
        }

        $tags = DB::table('tags')
            ->where('tag_name', '=', $request->tags_input)
            ->get();

        $page_tag = new PageTag;
        $page_tag->page_id = $page->id;
        $page_tag->tag_id = $tags[0]->id;
        $page_tag->save();



        return Redirect::route('pages.index', $min_page_nr);
    }

    /**
     * Display the specified resource.
     */
    public function show($number) {
        $text_blocks = DB::table('text_blocks')
            ->where('page_number', '=', $number)
            ->get();
        return view('pages', compact('number'))->with('text_blocks', $text_blocks);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
