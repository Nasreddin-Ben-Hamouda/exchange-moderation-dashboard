<?php

namespace Database\Seeders;

use App\Models\BlogUser;
use Illuminate\Database\Seeder;

class BlogUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creating 100 BlogUser rows in the DB
        BlogUser::factory()->count(20)->create();
    }
}
