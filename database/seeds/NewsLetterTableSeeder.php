<?php

use Illuminate\Database\Seeder;
use App\NewsLetter;

class NewsLetterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(NewsLetter::class, 10000)->create();
    }
}
