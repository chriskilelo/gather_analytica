<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_tags', function (Blueprint $table) {
            $table->id();
            // The [account_id] column helps to segregate the data in the DB based on the respective organizational accounts.
            $table->integer('account_id')->index();
            // Below is a foreign key linking this table to the polls table
            $table->foreignId('poll_id')->constrained('polls');
            // Below is a foreign key linking this table to the tags table
            $table->foreignId('tag_id')->constrained('tags');
            $table->timestamps();
            $table->softDeletes();
        });

        // Rename the pivot table to have the proper name i.e. the names of the two tables involved in singular
        Schema::rename('poll_tags', 'poll_tag');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_tags');
        Schema::dropIfExists('poll_tag');
    }
}
