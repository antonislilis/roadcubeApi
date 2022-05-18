<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        \DB::table('permissions')->delete();

        $permissions = array(
            //Admin
            [
                'id' => 1,
                'name' => 'show_logs',
                'category' => 'admin',
                'is_default' => true,
            ],
            [
                'id' => 2,
                'name' => 'delete_logs',
                'category' => 'admin',
                'is_default' => true,
            ],
            //Roles
            [
                'id' => 3,
                'name' => 'view',
                'category' => 'roles',
                'is_default' => true,
            ],
            [
                'id' => 4,
                'name' => 'edit',
                'category' => 'roles',
                'is_default' => true,
            ],
            [
                'id' => 5,
                'name' => 'create',
                'category' => 'roles',
                'is_default' => true,
            ],
            [
                'id' => 6,
                'name' => 'delete',
                'category' => 'roles',
                'is_default' => true,
            ],
            [
                'id' => 7,
                'name' => 'soft_delete',
                'category' => 'roles',
                'is_default' => true,
            ],
            //Users
            [
                'id' => 14,
                'name' => 'view',
                'category' => 'users',
                'is_default' => true,
            ],
            [
                'id' => 15,
                'name' => 'edit',
                'category' => 'users',
                'is_default' => true,
            ],
            [
                'id' => 16,
                'name' => 'create',
                'category' => 'users',
                'is_default' => true,
            ],
            [
                'id' => 17,
                'name' => 'delete',
                'category' => 'users',
                'is_default' => true,
            ],
            [
                'id' => 18,
                'name' => 'soft_delete',
                'category' => 'users',
                'is_default' => true,
            ],
            [
                'id' => 19,
                'name' => 'user_shops_delete',
                'category' => 'users',
                'is_default' => true,
            ],
            [
                'id' => 20,
                'name' => 'user_shops_update',
                'category' => 'users',
                'is_default' => true,
            ],
            //Account Type
            [
                'id' => 21,
                'name' => 'is_admin',
                'category' => 'account_type',
                'is_default' => true,
            ],
            [
                'id' => 22,
                'name' => 'is_shop',
                'category' => 'account_type',
                'is_default' => true,
            ],
            [
                'id' => 23,
                'name' => 'is_user',
                'category' => 'account_type',
                'is_default' => true,
            ],
            [
                'id' => 24,
                'name' => 'is_guest',
                'category' => 'account_type',
                'is_default' => true,
            ],

            [
                'id' => 25,
                'name' => 'view',
                'category' => 'stores',
                'is_default' => true,
            ],
            [
                'id' => 26,
                'name' => 'create',
                'category' => 'stores',
                'is_default' => true,
            ],
            [
                'id' => 27,
                'name' => 'delete',
                'category' => 'stores',
                'is_default' => true,
            ],
        );

        // Uncomment the below to run the seeder
        \DB::table('permissions')->insert($permissions);
    }

}
