<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\poll;
use App\Models\poll_answer;
use App\Models\poll_question;
use App\Models\poll_tag;
use App\Models\poll_vote;
use App\Models\tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $account = Account::create(['name' => 'Gather Analytica']);

        User::factory()->create([
            'account_id' => $account->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'password' => 'secret',
            'owner' => true,
        ]);

        User::factory(5)->create(['account_id' => $account->id]);

        $organizations = Organization::factory(100)
            ->create(['account_id' => $account->id]);

        Contact::factory(100)
            ->create(['account_id' => $account->id])
            ->each(function ($contact) use ($organizations) {
                $contact->update(['organization_id' => $organizations->random()->id]);
            });


        // Create sample data thorough a factory for [Polls]
        $polls = poll::factory(3)->create(['account_id' => $account->id]);

        // Create sample data thorough a factory for [Tags]
        $tags = tag::factory(20)->create(['account_id' => $account->id]);

        // Create sample data thorough a factory for [Poll Questions]
        $pollQuestions = poll_question::factory(20)->create(['account_id' => $account->id]);

        // // Create sample data thorough a factory for [Poll Answers]
        // $pollAnswers = poll_answer::factory(20)
        //     ->create(['account_id' => $account->id])
        //     ->each(function ($pollAnswer) use ($pollQuestions) {
        //         $pollAnswer->update(['poll_question_id' => $pollQuestions->random()->id]);
        //     });

        // // Create sample data thorough a factory for [Poll Votes]
        // $pollVotes = poll_vote::factory(20)->create(['account_id' => $account->id]);

        // // Create sample data thorough a factory for [Poll Tags]
        // $pollTags = poll_tag::factory(20)->create(['account_id' => $account->id]);
    }
}
