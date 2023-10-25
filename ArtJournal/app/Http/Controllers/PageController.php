<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Tag;
use App\Models\PageTag;
use App\Models\TextBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index($number) {
        $text_blocks = TextBlock::where('page_id', '=', $number)
            ->get();

        $page = Page::where('id', '=', $number)
            ->first();

        $isOwner = Auth::id() === $page->user_id;
//        dd($page_user_id);
        return view('pages', compact('number'))->with('text_blocks', $text_blocks)->with('isOwner', $isOwner);
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
        $page->page_name = $request->page_title;
        $max_page_nr = 0;
        if (DB::table('pages')->max('page_number') !== null) {
            $max_page_nr = DB::table('pages')->max('page_number');
        }
        $max_page_nr++;
        $page->page_number = $max_page_nr;
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



        return Redirect::route('pages.index', $max_page_nr);
    }

    /**
     * Display the specified resource.
     */
    public function show($number) {
        $text_blocks = DB::table('text_blocks')
            ->where('page_number', '=', $number)
            ->get();

        $isOwner = Auth::id() === $text_blocks->id;
        return view('pages', compact('number'))->with('text_blocks', $text_blocks)->with('isOwner', $isOwner);
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
    public function destroy(string $user, int $page_number) {
        Page::join('users', 'users.id', '=', 'pages.user_id')
            ->where('users.name', '=', $user)
            ->where('pages.page_number', '=', $page_number)
            ->delete();
        return back()->withInput();
    }
}
