<?php

use Illuminate\Database\Seeder;

use App\Constant\RoleConstant;

use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_administrator = new Role();
        $role_administrator->name = RoleConstant::ADMINISTRATOR;
        $role_administrator->description = 'Administrator';
        $role_administrator->save();

        $role_customer = new Role();
        $role_customer->name = RoleConstant::CUSTOMER;
        $role_customer->description = 'Pelanggan';
        $role_customer->save();

        $role_partner = new Role();
        $role_partner->name = RoleConstant::PARTNER;
        $role_partner->description = 'Mitra';
        $role_partner->save();
    }
}
