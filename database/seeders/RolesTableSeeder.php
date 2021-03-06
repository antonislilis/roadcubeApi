<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        \DB::table('roles')->delete();

        $roles = array(
            [
                'id' => 1, 'role' => 'admin', 'permissions' => '{
                    "admin": {
                        "show_logs": true,
                        "delete_logs": true
                    },
                    "account_type": {
                        "is_admin": true,
                        "is_user": false,
                        "is_guest": false
                    },
                    "stores": {
                        "view": true,
                        "create": true,
                        "delete": true
                    }
                }
            '],
            [
                'id' => 2, 'role' => 'user', 'permissions' => '{
                    "admin": {
                        "show_logs": true,
                        "delete_logs": false
                    },
                    "account_type": {
                        "is_admin": false,
                        "is_user": true,
                        "is_guest": false
                    },
                    "stores": {
                       "view": true,
                        "create": true,
                        "delete": false
                    }
                }
            '],
            [
                'id' => 3, 'role' => 'guest', 'permissions' => '{
                    "admin": {
                        "show_logs": false,
                        "delete_logs": false
                    },
                    "account_type": {
                        "is_admin": false,
                        "is_shop": false,
                        "is_user": false,
                        "is_guest": true
                    },
                    "stores": {
                       "view": true,
                        "create": false,
                        "delete": false
                    }
                }
            '],
        );

        \DB::table('roles')->insert($roles);
    }

}
