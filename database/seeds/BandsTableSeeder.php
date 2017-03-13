<?php

use App\Band;

use Carbon\Carbon;

use Illuminate\Database\Seeder;

class BandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 100) as $index) {
            $band = new Band;
            $band->name = $faker->company;
            $band->start_date = new Carbon($faker->date);
            $band->website = $faker->url;
            $band->still_active = $faker->boolean;
            $band->save();
        }
    }
}
