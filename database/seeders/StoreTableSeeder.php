<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $stores = \App\Models\Store::all();

        /*
         * Para cada laço do foreach criamos na tabela 'products' um produdo que está ligado a uma Store
         */
        foreach ($stores as $store) {

            $store->products()->save(\App\Models\Product::factory()->make());
        }
    }

}
