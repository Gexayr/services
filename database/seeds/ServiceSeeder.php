<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Internet',
            'IPTV',
            'Phone',
            'Duo',
            'Trio',
            'OTT'
            ];

        $desc = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum iure modi natus quibusdam voluptates.
         A dolorum earum illum quam saepe. Corporis, ex, sapiente.";

        $services = [];

        foreach ($names as $key => $name) {
            $services[$key]['name'] = $name;
            $services[$key]['description'] = $name . " " . $desc;
        }
        DB::table('services')->insert($services);
    }
}
