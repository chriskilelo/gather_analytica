<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Polls/Index', [
            'filters' => Request::all('search', 'trashed'),
            'polls' => Auth::user()->account->polls()
                ->orderBy('created_at')
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($poll) => [
                    'id' => $poll->id,
                    'title' => $poll->title,
                    'description' => $poll->description,
                    'start_date' => $poll->start_date,
                    'end_date' => $poll->end_date,
                    'is_active' => $poll->is_active,
                    'deleted_at' => $poll->deleted_at,
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
        return Inertia::render('Polls/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->account->polls()->create(
            Request::validate([
                'title' => ['required', 'max:255'],
                'description' => ['required', 'max:1000'],
                'start_date' => ['required', 'max:30'],
                'end_date' => ['required', 'max:30'],
                'is_active' => ['nullable', 'boolean']
            ])
        );

        return Redirect::route('polls')->with('success', 'Poll created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        return Inertia::render('Polls/Edit', [
            'poll' => [
                'id' => $poll->id,
                'title' => $poll->title,
                'description' => $poll->description,
                'start_date' => $poll->start_date,
                'end_date' => $poll->end_date,
                'is_active' => $poll->is_active,
                'deleted_at' => $poll->deleted_at,
                'pollQuestions' => $poll->pollQuestions()->orderByDateModified()->get()->map->only('id', 'question', 'is_active'),
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        $poll->update(
            Request::validate([
                'title' => ['required', 'max:255'],
                'description' => ['required', 'max:1000'],
                'start_date' => ['required', 'max:30'],
                'end_date' => ['required', 'max:30'],
                'is_active' => ['nullable', 'boolean'],
            ])
        );

        return Redirect::back()->with('success', 'Poll updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        // Delete the model from the database
        $poll->delete();

        return Redirect::back()->with('success', 'Poll deleted successfully.');
    }

        /**
     * Restore the specified resource by emptying the [deleted_at] column
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function restore(Poll $poll)
    {
        $poll->restore();

        return Redirect::back()->with('success', 'Poll restored successfully.');
    }
}
