<?php

namespace Database\Seeders;

use App\Models\Store;
use File;
use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        \DB::table('stores')->delete();

        Store::truncate();

        $json = File::get("database/data/stores.json");
        $stores = json_decode($json);

        foreach ($stores as $key => $value) {
            Store::create([
                "store_id" => $value->store_id,
                "parent_id" => $value->parent_id,
                "store_type_id" => $value->store_type_id,
                "name" => $value->name,
                "app_name" => $value->app_name,
                "address" => $value->address,
                "zip" => $value->zip,
                "email" => $value->email,
                "lat" => $value->lat,
                "lon" => $value->lon,
            ]);
        }
    }
}
