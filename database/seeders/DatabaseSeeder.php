<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\Poll;
use App\Models\PollAnswer;
use App\Models\PollQuestion;
use App\Models\PollTag;
use App\Models\PollVote;
use App\Models\Tag;
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
        Poll::factory(300)->create(['account_id' => $account->id]);

        // Create sample data thorough a factory for [Tags]
        Tag::factory(300)->create(['account_id' => $account->id]);

        // Create sample data thorough a factory for [Poll Questions]
        $pollQuestions = PollQuestion::factory(100)->create(['account_id' => $account->id]);

        // Create sample data thorough a factory for [Poll Answers]
        PollAnswer::factory(2000)
            ->create(['account_id' => $account->id])
            ->each(function ($pollAnswer) use ($pollQuestions) {
                $pollAnswer->update(['poll_question_id' => $pollQuestions->random()->id]);
            });

        // Create sample data thorough a factory for [Poll Votes]
        PollVote::factory(500)->create(['account_id' => $account->id]);

        // Create sample data thorough a factory for [Poll Tags]
        PollTag::factory(150)->create(['account_id' => $account->id]);
    }
}
