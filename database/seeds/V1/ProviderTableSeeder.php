<?php

namespace database\seeds\V1;

use Illuminate\Database\Seeder;
use Convenia\Models\V1\Provider;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class UsersTableSeeder
 */
class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::truncate();
        for ($i = 0; $i <= 10; $i++) {
            factory(Provider::class)->create();

        }
    }
}
