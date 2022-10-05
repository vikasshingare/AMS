<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Schedule;
use Hash;
use Spatie\Permission\Traits\HasRoles;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user= User::create([
            'name' => 'Vikas Shingare',
            'email' => 'vikas@gmail.com',
            'password' => Hash::make('password'),
        ]);
       
        $role = Role::create([
            'slug' => 'admin',
            'name' => 'Adminstrator',
        ]);
        $user->roles()->sync($role->id);

        $Schedule= Schedule::create([
            'slug' => 'General Shift',
            'time_in' => '09:30:00',
            'time_out' =>'06:30:00',
        ]);
    }
}
