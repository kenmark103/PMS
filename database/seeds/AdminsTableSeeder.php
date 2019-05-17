<?php

use Illuminate\Database\Seeder;
use App\Models\Admins;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->insert([
            'name' => Str::random(3).'Kenny',
            'email' => 'admin@gmail.com',
            'phonenumber'=>'0700307444',
            'password' => bcrypt('secret'),
            'roles_id'=>'1',
        ]);
    }
}
