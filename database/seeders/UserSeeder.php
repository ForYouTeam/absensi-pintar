<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'read-data'  ]);
        Permission::create(['name' => 'create-data']);
        Permission::create(['name' => 'update-data']);
        Permission::create(['name' => 'delete-data']);

        $roleSuAdmin = Role::create(['name' => 'super-admin']);
        $roleSuAdmin->givePermissionTo('read-data'  );
        $roleSuAdmin->givePermissionTo('create-data');
        $roleSuAdmin->givePermissionTo('update-data');
        $roleSuAdmin->givePermissionTo('delete-data');

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo('read-data'  );
        $roleAdmin->givePermissionTo('create-data');
        $roleAdmin->givePermissionTo('update-data');

        $roleGuru = Role::create(['name' => 'guru']);
        $roleGuru->givePermissionTo('read-data'  );
        $roleGuru->givePermissionTo('update-data');
        
        $uuid = Uuid::uuid4()->toString();
        $uuid2 = Uuid::uuid4()->toString();

        $user = User::create([
            'id'         => crc32($uuid)        ,
            'username'   => 'admin@gmail.com'   ,
            'password'   => Hash::make('123456'),
            'scope'      => 'super-admin'       ,
            'created_at' => Carbon::now()       ,
            'updated_at' => Carbon::now()       ,
        ]);

        $user->assignRole('super-admin');

        $user2 = User::create([
            'id'         => crc32($uuid2)        ,
            'username'   => 'yulianti'          ,
            'password'   => Hash::make('123456'),
            'scope'      => 'admin'             ,
            'created_at' => Carbon::now()       ,
            'updated_at' => Carbon::now()       ,
        ]);

        $user2->assignRole('admin');
    }
}
