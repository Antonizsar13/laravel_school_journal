<?php

namespace Database\Seeders\Users;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateSuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Super Admin',
        ]);

        $user = User::create([
            'first_name' => 'Admin',
            'father_name' => 'AdminOff',
            'last_name' => 'AdmonoVith',
            'email' => 'admin@admin.com',
            'password' => Hash::make(1),
        ]);

        $user->removeRole('guest');
        $user->assignRole($role);
    }
}
