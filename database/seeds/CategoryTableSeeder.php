<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::all();
        factory(\App\Category::class, 1)
            ->make()
            ->each(function (\App\Category $category) use ($user) {
                $userId = $user->random()->id;
                $category->user_id = $userId;
                $category->operation = rand(0, 1) ? 'CREDIT': 'DEBIT';
                $category->save();
            });
    }
}
