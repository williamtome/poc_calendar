<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'title' => 'Plantão Unimed',
            'color' => '#1E90FF',
            'start' => '2019-10-21',
            'end' => '2019-10-25',
        ]);
    }
}
