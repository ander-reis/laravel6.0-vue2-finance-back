<?php

use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::all();
        factory(\App\Account::class, 10)
            ->make()
            ->each(function (\App\Account $account) use ($user) {
                $userId = $user->random()->id;
                $account->user_id = $userId;
                $account->save();
            });
    }
}
