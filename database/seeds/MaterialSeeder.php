<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials_name = [
            'Benang Bordir',
            'Benang Jahit',
            'Benang Nilon',
            'Benang Obras',
            'Benang Sulam',
            'Benang Sutera',
            'Jarum Bordir',
            'Jarum Jahit',
            'Jarum Mesin Jahit',
            'Jarum Rajut',
            'Kain Denim',
            'Kain Fleece',
            'Kain Katun',
            'Kain Kulit',
            'Kain Parasut',
            'Kain Poliester',
            'Kain Spandeks',
            'Kain Satin',
            'Kain Sutera',
            'Kain Wol',
            'Kancing Bungkus',
            'Kancing Jepret',
            'Kancing Lubang',
            'Karet Elastis',
            'Resleting Metal',
            'Resleting Nilon',
            'Resleting Plastik',
            'Tinta Sablon Crack',
            'Tinta Sablon Discharge',
            'Tinta Sablon Extender',
            'Tinta Sablon Glow in The Dark',
            'Tinta Sablon Neo Pigmen',
            'Tinta Sablon Plastisol',
            'Tinta Sablon Rubber',
            'Tinta Sablon Superwhite',
            'Lainnya'
        ];

        $maxStocks = 10000;

        foreach ($materials_name as $name) {
            
            $material = new Material;
            $material->name = $name;
            $material->stock = rand(1,$maxStocks);
            $material->metric = "buah";
            $material->save();
        }
    }
}