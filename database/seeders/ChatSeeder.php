<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chats')->insert([
                'name' => 'Cosinha'
        ]);

        DB::table('chats')->insert([
            'name' => 'Negócios'
        ]);

        DB::table('chats')->insert([
            'name' => 'Nossa relação'
        ]);
    }
}
