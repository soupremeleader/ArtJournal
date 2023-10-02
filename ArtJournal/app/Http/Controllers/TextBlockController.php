<?php

namespace App\Http\Controllers;

use App\Models\TextBlock;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TextBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $textBlock = new TextBlock;
        $textBlock->content = $request->text_block_content;
        $textBlock->width = $request->width;
        $textBlock->height = $request->height;
        $textBlock->pos_x = $request->pos_x;
        $textBlock->pos_y = $request->pos_y;
        $textBlock->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
