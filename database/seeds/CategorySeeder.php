<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('categories')->truncate();

        $categories = [
            [
                'name' => 'Restaurants',
                'icon' => 'fa fa-utensils',
                'image' => 'Restaurants.jpg'
            ],
            [
                'name' => 'Food',
                'icon' => 'fa fa-pizza-slice',
                'image' => 'food.jpg'
            ],
            [
                'name' => 'Professional Services',
                'icon' => 'fa fa-laptop',
                'image' => 'Professional-Services.jpg'
            ],
            [
                'name' => 'Shopping',
                'icon' => 'fa fa-shopping-bag',
                'image' => 'Shopping.jpg'
            ],
            [
                'name' => 'Pets',
                'icon' => 'fa fa-paw',
                'image' => 'Pets.jpg'
            ],
            [
                'name' => 'Hostel & Travel',
                'icon' => 'fa fa-plane',
                'image' => 'Hostel-&-Travel.jpg'
            ],
            [
                'name' => 'Auto',
                'icon' => 'fa fa-car',
                'image' => 'Auto.jpg'
            ],
            [
                'name' => 'Arts & Entertainment',
                'icon' => 'fa fa-palette',
                'image' => 'Arts-&-Entertainment.jpg'
            ],
            [
                'name' => 'Health & Medical',
                'icon' => 'fa fa-heartbeat',
                'image' => 'Health-&-Medical.jpg'
            ],
            [
                'name' => 'Real Estate',
                'icon' => 'fa fa-sign',
                'image' => 'Real-Estate.jpg'
            ],
            [
                'name' => 'Financial Services',
                'icon' => 'fa fa-coins',
                'image' => 'Financial-Services.jpg'
            ]
        ];

        \Illuminate\Support\Facades\DB::table('categories')->insert($categories);
    }
}
