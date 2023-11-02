<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request) {
//        error_log("here " . $request);
        $tagNames = DB::table('tags')
            ->where('tag_name', 'like', "%".$request->tag."%")
            ->get();
        return response()->json(['tagNames' => $tagNames]);
    }
}
