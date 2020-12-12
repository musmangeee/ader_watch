<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TownTableSeeder::class);
        $this->call(PackageSeeder::class);

        /*
         * Factories
         */

        factory(App\User::class, 200)->create();
        // factory(App\Business::class, 2000)->create();
//        factory(App\Review::class, 10000)->create()->each(function ($business) {
//
//        });


        foreach (\App\Business::all() as $b) {
            if (!(\Illuminate\Support\Facades\DB::table('model_has_roles')->where('role_id', 2)->where('model_id', $b->user_id)->first()) != null)
            \Illuminate\Support\Facades\DB::table('model_has_roles')->insert(array('role_id' => 2, 'model_type' => 'App\User', 'model_id' => $b->user_id));
        }


    }
}
