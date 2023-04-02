<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_votes', function (Blueprint $table) {
            $table->id();
            // The [account_id] column helps to segregate the data in the DB based on the respective organizational accounts.
            $table->integer('account_id')->index();
            // Below is a foreign key linking this table to the polls table
            $table->foreignId('poll_id')->constrained('polls');
            // Below is a foreign key linking this table to the [poll questions] table
            $table->foreignId('poll_question_id')->constrained('poll_questions');
            // Below is a foreign key linking this table to the [poll answers] table
            $table->foreignId('poll_answer_id')->constrained('poll_answers');
            // Below is a foreign key linking this table to the [users] table
            $table->foreignId('user_id')->constrained('users');
            // Active flag
            $table->boolean('is_active')->default(true);
            // System generated time stamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_votes');
    }
}
