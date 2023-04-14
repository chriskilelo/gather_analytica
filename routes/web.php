<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\PollAnswerController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PollQuestionController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Organizations

Route::get('organizations', [OrganizationsController::class, 'index'])
    ->name('organizations')
    ->middleware('auth');

Route::get('organizations/create', [OrganizationsController::class, 'create'])
    ->name('organizations.create')
    ->middleware('auth');

Route::post('organizations', [OrganizationsController::class, 'store'])
    ->name('organizations.store')
    ->middleware('auth');

Route::get('organizations/{organization}/edit', [OrganizationsController::class, 'edit'])
    ->name('organizations.edit')
    ->middleware('auth');

Route::put('organizations/{organization}', [OrganizationsController::class, 'update'])
    ->name('organizations.update')
    ->middleware('auth');

Route::delete('organizations/{organization}', [OrganizationsController::class, 'destroy'])
    ->name('organizations.destroy')
    ->middleware('auth');

Route::put('organizations/{organization}/restore', [OrganizationsController::class, 'restore'])
    ->name('organizations.restore')
    ->middleware('auth');

// Contacts

Route::get('contacts', [ContactsController::class, 'index'])
    ->name('contacts')
    ->middleware('auth');

Route::get('contacts/create', [ContactsController::class, 'create'])
    ->name('contacts.create')
    ->middleware('auth');

Route::post('contacts', [ContactsController::class, 'store'])
    ->name('contacts.store')
    ->middleware('auth');

Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
    ->name('contacts.edit')
    ->middleware('auth');

Route::put('contacts/{contact}', [ContactsController::class, 'update'])
    ->name('contacts.update')
    ->middleware('auth');

Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
    ->name('contacts.destroy')
    ->middleware('auth');

Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
    ->name('contacts.restore')
    ->middleware('auth');

// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');


// Polls operations
Route::get('polls', [PollController::class, 'index'])
    ->name('polls')
    ->middleware('auth');

Route::get('polls/create', [PollController::class, 'create'])
    ->name('polls.create')
    ->middleware('auth');

Route::post('polls', [PollController::class, 'store'])
    ->name('polls.store')
    ->middleware('auth');

Route::get('polls/{poll}/edit', [PollController::class, 'edit'])
    ->name('polls.edit')
    ->middleware('auth');

Route::put('polls/{poll}', [PollController::class, 'update'])
    ->name('polls.update')
    ->middleware('auth');

Route::delete('polls/{poll}', [PollController::class, 'destroy'])
    ->name('polls.destroy')
    ->middleware('auth');

Route::put('polls/{poll}/restore', [PollController::class, 'restore'])
    ->name('polls.restore')
    ->middleware('auth');


// Poll Questions
Route::get('poll_questions', [PollQuestionController::class, 'index'])
->name('poll_questions')
->middleware('auth');

Route::get('poll_questions/create', [PollQuestionController::class, 'create'])
->name('poll_questions.create')
->middleware('auth');

Route::post('poll_questions', [PollQuestionController::class, 'store'])
->name('poll_questions.store')
->middleware('auth');

Route::get('poll_questions/{poll_question}/edit', [PollQuestionController::class, 'edit'])
->name('poll_questions.edit')
->middleware('auth');

Route::put('poll_questions/{poll_question}', [PollQuestionController::class, 'update'])
->name('poll_questions.update')
->middleware('auth');

Route::delete('poll_questions/{poll_question}', [PollQuestionController::class, 'destroy'])
->name('poll_questions.destroy')
->middleware('auth');

Route::put('poll_questions/{poll_question}/restore', [PollQuestionController::class, 'restore'])
->name('poll_questions.restore')
->middleware('auth');





// Poll Answers
Route::get('poll_answers', [PollAnswerController::class, 'index'])
->name('poll_answers')
->middleware('auth');

Route::get('poll_answers/create', [PollAnswerController::class, 'create'])
->name('poll_answers.create')
->middleware('auth');

Route::post('poll_answers', [PollAnswerController::class, 'store'])
->name('poll_answers.store')
->middleware('auth');

Route::get('poll_answers/{poll_answer}/edit', [PollAnswerController::class, 'edit'])
->name('poll_answers.edit')
->middleware('auth');

Route::put('poll_answers/{poll_answer}', [PollAnswerController::class, 'update'])
->name('poll_answers.update')
->middleware('auth');

Route::delete('poll_answers/{poll_answer}', [PollAnswerController::class, 'destroy'])
->name('poll_answers.destroy')
->middleware('auth');

Route::put('poll_answers/{poll_answer}/restore', [PollAnswerController::class, 'restore'])
->name('poll_answers.restore')
->middleware('auth');