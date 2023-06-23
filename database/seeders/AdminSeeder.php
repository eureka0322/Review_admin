<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin User
        $user = User::create([
            'name'    => 'Super',
            'email'         =>  'admin@admin.com',
            'password'      =>  Hash::make('Admin@123#'),
            'gender'      =>  '1',
            'birth' => Carbon::create(1990, 3, 22),
            'prefecture_id' => 19,
            'city_id' => 844,
            'role_id'       => 1,
            'status' => 1
        ]);
    }
}
