<?php

use Illuminate\Database\Seeder;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('questions')->delete();
        DB::table('answers')->delete();

        factory(\App\User::class, 4)->create()->each(function ($user)
        {
            $user->questions()
                 ->saveMany(
                        factory(\App\Question::class, rand(2,5))->make()
                 )
                 ->each(function ($question) {
                    $question->answers()
                             ->saveMany(
                             factory(\App\Answer::class, rand(1,3))->make()
                             );
                  });
        });
    }
}
