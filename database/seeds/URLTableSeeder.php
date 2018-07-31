<?php

use Illuminate\Database\Seeder;
use App\Models\URL;

class URLTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        URL::truncate();
        $URLQuantity = 50;
        factory(URL::class, $URLQuantity)->create();
    }
}
