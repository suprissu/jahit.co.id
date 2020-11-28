<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Constant\ChatTemplateConstant;
use App\Constant\ProjectStatusConstant;

use App\Models\Chat;
use App\Models\Customer;
use App\Models\Inbox;
use App\Models\Partner;
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
            'Pakaian Pria',
            'Pakaian Wanita',
            'Pakaian Anak',
            'Seragam Sekolah',
            'Seragam Organisasi',
            'Seragam Kantor',
            'Seragam Rumah Sakit',
            'Safetywear'
        ];

        foreach ($customers as $customer) {
            for ($i = 1; $i <= rand(1,$maxProjectNumberEachCustomer); $i++) {
                
                $project = new Project;
                $project->name = $categories[array_rand($categories)] . ' ' . $faker->colorName;
                $project->address = $faker->address;
                $project->count = rand(1,200);
                $project->status = ProjectStatusConstant::PROJECT_OPENED;
                $project->category_id =  rand(1,count($categories));
                $project->note = $faker->text($maxNbChars = 350);
        
                $customer->projects()->save($project);
        
                for ($i = 1; $i <= rand(1,$maxProjectImageNumber); $i++) {
                    $projectImage = new ProjectImage;
                    $projectImage->path = '/img/customer/project/design/dummy-' . rand(1,10) . '.jpg';
                    $projectImage->project()->associate($project);
                    $projectImage->save();
                }

                $partners = Partner::all();
                foreach($partners as $partner){
                    $inbox = new Inbox;
                    $inbox->partner_id = $partner->id;
                    $inbox->customer_id = $customer->id;
                    $inbox->project()->associate($project);
                    $inbox->save();

                    $chatInit = new Chat;
                    $chatInit->role = ChatTemplateConstant::CUSTOMER_ROLE;
                    $chatInit->type = ChatTemplateConstant::INITIATION_TYPE;
                    $chatInit->inbox()->associate($inbox);
                    $chatInit->save();
                                    
                    $chatNego = new Chat;
                    $chatNego->role = ChatTemplateConstant::CUSTOMER_ROLE;
                    $chatNego->type = ChatTemplateConstant::NEGOTIATION_TYPE;
                    $chatNego->answer = ChatTemplateConstant::BLANK_ANSWER;
                    $chatNego->inbox()->associate($inbox);
                    $chatNego->save();
                }
            }
        }
    }
}