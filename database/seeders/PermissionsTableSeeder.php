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
            //Account Type
            [
                'id' => 3,
                'name' => 'is_admin',
                'category' => 'account_type',
                'is_default' => true,
            ],
            [
                'id' => 4,
                'name' => 'is_shop',
                'category' => 'account_type',
                'is_default' => true,
            ],
            [
                'id' => 5,
                'name' => 'is_user',
                'category' => 'account_type',
                'is_default' => true,
            ],
            [
                'id' => 6,
                'name' => 'is_guest',
                'category' => 'account_type',
                'is_default' => true,
            ],

            [
                'id' => 7,
                'name' => 'view',
                'category' => 'stores',
                'is_default' => true,
            ],
            [
                'id' => 8,
                'name' => 'create',
                'category' => 'stores',
                'is_default' => true,
            ],
            [
                'id' => 9,
                'name' => 'delete',
                'category' => 'stores',
                'is_default' => true,
            ],
        );

        // Uncomment the below to run the seeder
        \DB::table('permissions')->insert($permissions);
    }

}
