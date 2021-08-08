<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Muhamad Iqbal Fadilah',
            'email' => 'laku0505@gmail.com',
            'password' => bcrypt('Market22'),
        ]);

        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'index user']);

        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Wildan Ardiansyah',
            'email' => 'wildanard@gmail.com',
            'password' => bcrypt('Market22'),
        ]);

        $role = Role::create(['name' => 'cashier']);
        $permission = Permission::create(['name' => 'not index user']);

        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        $user->assignRole('cashier');
    }
}
