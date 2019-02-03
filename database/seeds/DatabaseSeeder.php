<?php

use Illuminate\Database\Seeder;
use database\seeds\V1\UsersTableSeeder;
use database\seeds\V1\ProviderTableSeeder;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(ProviderTableSeeder::class);
    }
}
