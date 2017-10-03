<?php

use Illuminate\Database\Seeder;

class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $video = factory(\App\Video::class)->create();
        $product = factory(\App\Product::class)->make();
        $video->products()->save($product);
    }
}
