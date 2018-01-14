<?php

use Illuminate\Database\Seeder;
use App\TypeSale;

class TypeSaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'name' => 'Cotización'
            ],
            [
                'name' => 'Venta'
            ],
        );

        TypeSale::insert($data);
    }
}
