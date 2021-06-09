<?php

namespace App\Http\Controllers;

use App\Models\StudInsert;
use Illuminate\Http\Request;

class StudInsertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $msg = "This is a simple message.";
        return response()->json(array('msg'=> $msg), 200);

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudInsert  $studInsert
     * @return \Illuminate\Http\Response
     */
    public function show(StudInsert $studInsert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudInsert  $studInsert
     * @return \Illuminate\Http\Response
     */
    public function edit(StudInsert $studInsert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudInsert  $studInsert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudInsert $studInsert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudInsert  $studInsert
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudInsert $studInsert)
    {
        //
    }
}
