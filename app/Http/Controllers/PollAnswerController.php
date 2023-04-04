<?php

namespace App\Http\Controllers;

use App\Models\PollAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PollAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
     * @param  \App\Models\PollAnswer  $pollAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(PollAnswer $pollAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PollAnswer  $pollAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(PollAnswer $pollAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollAnswer  $pollAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PollAnswer $pollAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollAnswer  $pollAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PollAnswer $pollAnswer)
    {
        // Delete the model from the database
        $pollAnswer->delete();
        return Redirect::back()->with('success', 'Poll answer deleted.');
    }

     /**
     * Restore the specified model instance
     *
     * @param  \App\Models\PollAnswer  $pollAnswer
     * @return \Illuminate\Http\Response
     */
    public function restore(PollAnswer $pollAnswer)
    {
        // Restore a soft-deleted model instance by making null the [deleted_at] column in the database
        $pollAnswer->restore();
        return Redirect::back()->with('success', 'Poll answer restored.');
    }
}
