<?php

namespace Database\Seeders;

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

        $this->call(UsersTableSeeder::class); //Para criar usuário com loja
        $this->call(StoreTableSeeder::class); //Para criar loja com produto
    }
}
