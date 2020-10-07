<?php

use Illuminate\Database\Seeder;

use App\Models\ProjectCategory;

class ProjectCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            'Seragam Sekolah',
            'Topi Sekolah',
            'Baju Olahraga',
            'Jaket Sekolah',
            'Jaket Universitas',
            'Jaket Organisasi',
            'Seragam Dinas',
            'Custom Jaket',
            'Custom Kaos',
            'Custom Kemeja',
            'Custom Celana',
            'Jersey',
            'Masker'
        ];

        foreach ($categories as $category) {
            $projectCategory = new ProjectCategory();
            $projectCategory->name = $category;
            $projectCategory->save();
        }

    }
}
