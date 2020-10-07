<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Constant\ProjectStatusConstant;

use App\Models\Customer;
use App\Models\Project;
use App\Models\ProjectImage;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maxProjectNumberEachCustomer = 4;
        $maxProjectImageNumber = 4;

        $faker = Faker::create('id_ID');
        $customers = Customer::all();

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

        foreach ($customers as $customer) {
            for ($i = 1; $i <= rand(1,$maxProjectNumberEachCustomer); $i++) {
                
                $project = new Project;
                $project->name = $categories[array_rand($categories)] . ' ' . $faker->colorName;
                $project->address = $faker->address;
                $project->count = rand(1,200);
                $project->status = ProjectStatusConstant::OPEN;
                $project->category_id =  rand(1,count($categories));
                $project->note = $faker->text($maxNbChars = 350);
        
                $customer->projects()->save($project);
        
                for ($i = 1; $i <= rand(1,$maxProjectImageNumber); $i++) {
                    $projectImage = new ProjectImage;
                    $projectImage->path = '/img/customer/project/design/dummy-' . rand(1,10) . '.jpg';
                    $projectImage->project()->associate($project);
                    $projectImage->save();
                }
            }
        }
    }
}