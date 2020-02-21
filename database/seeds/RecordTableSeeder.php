<?php

use Illuminate\Database\Seeder;

class RecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::all();
        $account = \App\Account::all();
        $category = \App\Category::all();
        factory(\App\Record::class, 1)
            ->make()
            ->each(function (\App\Record $record) use ($user, $account, $category) {
                $userId = $user->random()->id;
                $accountId = $account->random()->id;
                $categoryId = $category->random()->id;
                $record->user_id = $userId;
                $record->account_id = $accountId;
                $record->category_id = $categoryId;
                $record->type = rand(0, 1) ? 'CREDIT' : 'DEBIT';
                $record->save();
            });
    }
}
