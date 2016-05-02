<?php

use App\Room;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'name' => '單人房',
            'price' => 1000,
        ]);

        Room::create([
            'name' => '雙人房',
            'price' => 2000,
        ]);
    }
}
