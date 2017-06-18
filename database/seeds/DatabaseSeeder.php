<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(AssetSeeder::class);
        $this->call(CarouselSeeder::class);
        $this->call(LinkPageSeeder::class);
    }
}
