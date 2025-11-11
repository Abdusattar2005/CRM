<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name'=>'admin']);
        Role::firstOrCreate(['name'=>'manager']);

        $admin = User::firstOrCreate(['email'=>'admin@example.test'], [
            'name' => 'Admin', 'password' => bcrypt('secret')
        ]);
        $admin->assignRole('admin');

        $manager = User::firstOrCreate(['email'=>'manager@example.test'], [
            'name' => 'Manager', 'password' => bcrypt('secret')
        ]);
        $manager->assignRole('manager');
    }
}
