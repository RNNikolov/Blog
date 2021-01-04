<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::factory()->count(20)
            ->create()
            ->each(function ($profile) {
                $profile->image()->create(['url' => asset('images/default2.jpg')]);
            });
    }
}
