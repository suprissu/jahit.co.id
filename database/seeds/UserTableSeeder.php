<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Constant\RoleConstant;

use App\Models\Customer;
use App\Models\Partner;
use App\Models\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createDummyAdministrators(3);
        // $this->createDummyCustomers(10);
        // $this->createDummyPartners(10);
    }
    
    private function createDummyAdministrators($times)
    {
        $faker = Faker::create('id_ID');
        $roleAdministrator = Role::where('name', RoleConstant::ADMINISTRATOR)->first();
        
        for ($i = 1; $i <= $times; $i++) {
            $userAdministrator = new User();
            $userAdministrator->name = 'Administrator ' . $i;
            $userAdministrator->email = 'administrator' . $i . '@jahit.co.id';
            $userAdministrator->password = bcrypt('Secret123');
            $userAdministrator->is_active = true;
            $userAdministrator->save();
            $userAdministrator->roles()->attach($roleAdministrator);
        }
    }

    private function createDummyCustomers($times)
    {
        $faker = Faker::create('id_ID');
        $roleCustomer = Role::where('name', RoleConstant::CUSTOMER)->first();

        for ($i = 1; $i <= $times; $i++) {
            $userCustomer = new User();
            $userCustomer->name = $faker->name;
            $userCustomer->email = $faker->email;
            $userCustomer->password = bcrypt('Secret123');
            $userCustomer->is_active = $faker->boolean($chanceOfGettingTrue = 75);
            $userCustomer->save();
            $userCustomer->roles()->attach($roleCustomer);

            $customer = new Customer;
            $customer->company_name = $faker->company;
            $customer->phone_number = $faker->phoneNumber;

            $userCustomer->customer()->save($customer);
        }
    }

    private function createDummyPartners($times)
    {
        $faker = Faker::create('id_ID');
        $rolePartner = Role::where('name', RoleConstant::PARTNER)->first();

        for ($i = 1; $i <= $times; $i++) {
            $userPartner = new User();
            $userPartner->name = $faker->name;
            $userPartner->email = $faker->email;
            $userPartner->password = bcrypt('Secret123');
            $userPartner->is_active = $faker->boolean($chanceOfGettingTrue = 75);
            $userPartner->save();
            $userPartner->roles()->attach($rolePartner);

            $partner = new Partner;
            $partner->company_name = $faker->company;
            $partner->phone_number = $faker->phoneNumber;
            $partner->address = $faker->address;
            $partner->ktp_pict_link = '/img/partner/ktp/dummy-' . rand(1,3) . '.jpg';
            $partner->npwp_pict_link = '/img/partner/npwp/dummy-' . rand(1,3) . '.jpg';

            $userPartner->Partner()->save($partner);
        }
    }
}
