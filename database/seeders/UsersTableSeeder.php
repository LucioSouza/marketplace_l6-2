<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        /*
         * Para cada (each) criação de um usuário, é chamada um função que utiliza do objeto $user a função store()
         * (definida no Model User), e aplico o método save() para salvar uma Store na tabela Stores para cada User criado
         */
        \App\Models\User::factory(20)->create()->each(function ($user) {
            $user->store()->save(\App\Models\Store::factory()->make());
        });
    }

}
