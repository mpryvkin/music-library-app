<?php

use App\Band;
use App\Album;

use Carbon\Carbon;

use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $genres = ['Pop', 'Rock', 'Jazz', 'Classical', 'Country', 'Disco', 'Blues'];

        $bands = Band::get();
        foreach ($bands as $band) {
            foreach (range(1,3) as $index) {
                $album = new Album;
                $album->band_id = $band->id;
                $album->name = $faker->catchPhrase;
                $album->recorded_date = new Carbon($faker->date);
                $album->release_date = new Carbon($faker->date);
                $album->number_of_tracks = $faker->numberBetween(5, 12);
                $album->label = $faker->company;
                $album->producer = $faker->name;
                $album->genre = $genres[$faker->numberBetween(0, 6)];
                $album->save();
            }
        }
    }
}
