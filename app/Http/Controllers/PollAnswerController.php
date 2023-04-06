<?php

namespace App\Http\Controllers;

use App\Models\PollAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class PollAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('PollAnswers/Index', [
            'filters' => Request::all('search', 'trashed'),
            'poll_answers' => Auth::user()->account->pollAnswers()
                ->with('pollQuestion')
                ->orderByDateModified()
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($pollAnswer) => [
                    'id' => $pollAnswer->id,
                    'answer' => $pollAnswer->answer,
                    'is_active' => $pollAnswer->is_active,
                    'pollQuestion' => $pollAnswer->pollQuestion ? $pollAnswer->pollQuestion->only('id', 'question', 'poll_id', 'created_at') : null,
                ]),
        ]);
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
        // Redirect back with a success message
        return Redirect::back()->with('success', 'Poll answer deleted successfully.');
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
        // Redirect back with a success message
        return Redirect::back()->with('success', 'Poll answer restored successfully.');
    }
}
