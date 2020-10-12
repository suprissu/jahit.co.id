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
            'Pakaian Pria',
            'Pakaian Wanita',
            'Pakaian Anak',
            'Seragam Sekolah',
            'Seragam Organisasi',
            'Seragam Kantor',
            'Seragam Rumah Sakit',
            'Safetywear'
        ];

        foreach ($categories as $category) {
            $projectCategory = new ProjectCategory();
            $projectCategory->name = $category;
            $projectCategory->save();
        }

    }
}   
