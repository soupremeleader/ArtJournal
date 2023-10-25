<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyJournalController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($user) {
        $users = User::where("name", '=', $user)
        ->first();

        $isLoggedIn = Auth::check();
        $userName = null;
        if ($isLoggedIn) {
            $userName = User::where('id', '=', Auth::id())->first();
            $userName = $userName->name;
        }

        $existingTags = Tag::select('tags.*')->get();

        $tags = Page::join('page_tags', 'page_tags.page_id', '=', 'pages.id')
            ->join('tags', 'tags.id', '=', 'page_tags.tag_id')
            ->join('users', 'users.id', '=', 'pages.user_id')
            ->where('pages.user_id', '=', $users->id)
            ->select('pages.*', 'tags.*', 'users.name')
            ->get();

//        dd($tags);
        return view('home')
            ->with('tags', $tags)
            ->with('filter')
            ->with('isLoggedIn', $isLoggedIn)
            ->with('userName', $userName)
            ->with('existingTags', $existingTags);
    }

    public function show(Request $request) {
        $isLoggedIn = Auth::check();
        $userName = null;
        if ($isLoggedIn) {
            $userName = User::where('id', '=', Auth::id())->first();
            $userName = $userName->name;
        }

        $existingTags = Tag::select('tags.*')->get();


        if ($request->filterTagInput === null) {
            $tags = Tag::join('page_tags', 'page_tags.tag_id', '=', 'tags.id')
                ->join('pages', 'page_tags.page_id', '=', 'pages.id')
                ->join('users', 'pages.user_id', '=', 'users.id')
                ->where('pages.page_name', 'like', '%'.$request->filterInput.'%')
                ->where('pages.user_id', '=', Auth::id())
                ->select('pages.*', 'tags.*', 'users.name')
                ->get();
        } else {
            $tags = Tag::where('tags.tag_name', '=', $request->filterTagInput)
                ->join('page_tags', 'page_tags.tag_id', '=', 'tags.id')
                ->join('pages', 'page_tags.page_id', '=', 'pages.id')
                ->join('users', 'pages.user_id', '=', 'users.id')
                ->where('pages.page_name', 'like', '%' . $request->filterInput . '%')
                ->where('pages.user_id', '=', Auth::id())
                ->select('pages.*', 'tags.*', 'users.name')
                ->get();
        }

        return view('home')
            ->with('filter', $request->filterInput)
            ->with('isLoggedIn', $isLoggedIn)
            ->with('userName', $userName)
            ->with('existingTags', $existingTags)
            ->with('tags', $tags);
    }
}
