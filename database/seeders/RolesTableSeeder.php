<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        \DB::table('roles')->delete();

        $roles = array(
            ['id' => 1, 'role' => 'admin', 'permissions' => '{
	"admin": {
		"show_logs": true,
		"delete_logs": true
	},
	"users": {
		"view": true,
		"create": true,
		"edit": true,
		"delete": true,
		"soft_delete": true,
		"user_shops_update": true,
		"user_shops_delete": true
	},
	"roles": {
		"view": true,
		"create": true,
		"edit": true,
		"delete": true,
		"soft_delete": true
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
}'],
            ['id' => 2, 'role' => 'user', 'permissions' => '{
	"admin": {
		"show_logs": true,
		"delete_logs": false
	},
	"users": {
		"view": false,
		"create": false,
		"edit": false,
		"delete": false,
		"soft_delete": false,
		"user_shops_update": false,
		"user_shops_delete": false
	},
	"roles": {
		"view": false,
		"create": false,
		"edit": false,
		"delete": false,
		"soft_delete": false
	},
	"account_type": {
		"is_admin": false,
		"is_user": true,
		"is_guest": false
	},
	"properties": {
	   "view": true,
		"create": true,
		"delete": false
	}
}
            '],
            ['id' => 3, 'role' => 'guest', 'permissions' => '{
	"admin": {
		"show_logs": false,
		"delete_logs": false
	},
	"users": {
		"view": false,
		"create": false,
		"edit": false,
		"delete": false,
		"soft_delete": false,
		"user_shops_update": false,
		"user_shops_delete": false
	},
	"roles": {
		"view": false,
		"create": false,
		"edit": false,
		"delete": false,
		"soft_delete": false
	},
	"account_type": {
		"is_admin": false,
		"is_shop": false,
		"is_user": false,
		"is_guest": true
	},
	"properties": {
	   "view": true,
		"create": false,
		"delete": false
	}
}
            '],
        );

        // Uncomment the below to run the seeder
        \DB::table('roles')->insert($roles);
    }

}
