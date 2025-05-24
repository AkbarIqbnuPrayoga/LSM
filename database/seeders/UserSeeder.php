<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $arr = ['Admin', 'Member'];
        foreach ($arr as $key => $value) {
            Role::create(['name' => $value]);
        }
        $admin = User::create([
            'name'     => 'Admin 1',
            'email'    => 'prayogaiqbnu@gmail.com',
            'password' => Hash::make(123123),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('Admin');

        $member = User::create([
            'name'     => 'member 1',
            'email'    => 'member@mail.com',
            'password' => Hash::make(123123),
            'email_verified_at' => now(),
        ]);
        $member->assignRole('Member');
    }
}