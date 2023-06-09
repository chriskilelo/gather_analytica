<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_answers', function (Blueprint $table) {
            $table->id();
            // The [account_id] column helps to segregate the data in the DB based on the respective organizational accounts.
            $table->integer('account_id')->index();
            $table->string('answer');
            $table->boolean('is_active')->default(false);
            $table->foreignId('poll_question_id')->constrained('poll_questions');
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
        Schema::dropIfExists('poll_answers');
    }
}
