<?php

namespace App\Http\Controllers;

use App\Models\PollQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class PollQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('PollQuestions/Index', [
            'filters' => Request::all('search', 'trashed'),
            'poll_questions' => Auth::user()->account->pollQuestions()
                ->orderByDateModified('')
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($poll_question) => [
                    'id' => $poll_question->id,
                    'question' => $poll_question->question,
                    'is_active' => $poll_question->is_active,
                    'deleted_at' => $poll_question->deleted_at,
                    'poll' => $poll_question->poll ? $poll_question->poll->only('id', 'title', 'start_date', 'end_date') : null,
                ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('PollQuestions/Create', [
            'polls' => Auth::user()->account
                ->polls()
                ->get()
                ->map
                ->only('id', 'title', 'start_date', 'end_date')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->account->pollQuestions()->create(
            Request::validate([
                'question' => ['required', 'max:255'],
                'is_active' => ['required', 'boolean'],
                'poll_id' => [
                    'required',
                    Rule::exists('polls', 'id')->where(fn ($query) => $query->where('account_id', Auth::user()->account_id)),
                ],
            ])
        );

        return Redirect::route('poll_questions')->with('success', 'Poll question created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PollQuestion  $pollQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(PollQuestion $pollQuestion)
    {
        return Inertia::render('PollQuestions/Edit', [
            'poll_question' => [
                'id' => $pollQuestion->id,
                'question' => $pollQuestion->question,
                'poll_id' => $pollQuestion->poll_id,
                'is_active' => $pollQuestion->is_active,
                'deleted_at' => $pollQuestion->deleted_at,
                'pollAnswers' => $pollQuestion->pollAnswers()->get()->map->only('id', 'answer', 'is_active'),
            ],
            'polls' => Auth::user()->account->polls()
                ->get()
                ->map
                ->only('id', 'title', 'description', 'start_date', 'end_date', 'is_active'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollQuestion  $pollQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PollQuestion $pollQuestion)
    {
        $pollQuestion->update(
            Request::validate([
                'question' => ['required', 'max:255'],
                'is_active' => ['required', false],
                'poll_id' => [
                    'nullable',
                    Rule::exists('polls', 'id')->where(fn ($query) => $query->where('account_id', Auth::user()->account_id)),
                ],
            ])
        );

        return Redirect::back()->with('success', 'Poll question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollQuestion  $pollQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(PollQuestion $pollQuestion)
    {
        $pollQuestion->delete();
        return Redirect::back()->with('success', 'Poll question deleted successfully.');
    }


    /**
     * Remove the value of the [deleted_at] column so that we un-softdelete/restore the data.
     *
     * @param  \App\Models\PollQuestion  $pollQuestion
     * @return \Illuminate\Http\Response
     */
    public function restore(PollQuestion $pollQuestion)
    {
        $pollQuestion->restore();
        return Redirect::back()->with('success', 'Poll question restored successfully.');
    }
}
