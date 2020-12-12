<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('cities')->truncate();

        $cities = [
            [
                "id" => 1,
                "name" => "Accra"
            ],
            [
                "id" => 2,
                "name" => "Kumasi"
            ],
            [
                "id" => 3,
                "name" => "Tema"
            ],
            [
                "id" => 4,
                "name" => "Takoradi"
            ],
            [
                "id" => 5,
                "name" => "Cape Coast"
            ],
            [
                "id" => 6,
                "name" => "Sunyani"
            ],
            [
                "id" => 7,
                "name" => "Tamale"
            ],
            [
                "id" => 8,
                "name" => "Ho"
            ],
            [
                "id" => 9,
                "name" => "Tachiman"
            ],
            [
                "id" => 10,
                "name" => "Goaso"
            ],
            [
                "id" => 11,
                "name" => "Koforidua"
            ],
            [
                "id" => 12,
                "name" => "Damongo"
            ],
            [
                "id" => 13,
                "name" => "Nalerigu"
            ],
            [
                "id" => 14,
                "name" => "Bolgatanga"
            ],
            [
                "id" => 15,
                "name" => "Wa"
            ],
            [
                "id" => 16,
                "name" => "Dumbai"
            ],
            [
                "id" => 17,
                "name" => "Wiawso"
            ]

        ];

        \Illuminate\Support\Facades\DB::table('cities')->insert($cities);
    }
}
