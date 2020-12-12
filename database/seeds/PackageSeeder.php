<?php

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('packages')->truncate();
        $packages = [
            ['name' => 'Basic', 'description' => 'Basic Package', 'price' => 20 , 'amount_per_view' => 0.10, 'total_views' =>  100],
            ['name' => 'Premium', 'description' => 'Basic Package', 'price' => 50 , 'amount_per_view' => 0.10, 'total_views' =>  1000],
            ['name' => 'Gold', 'description' => 'Basic Package', 'price' => 100 , 'amount_per_view' => 0.10, 'total_views' =>  3000]
        ];

        \Illuminate\Support\Facades\DB::table('packages')->insert($packages);
    }
}
