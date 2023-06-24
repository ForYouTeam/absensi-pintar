<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uuid = Uuid::uuid4()->toString();

        User::insert([
            'id'         => crc32($uuid)        ,
            'username'   => 'admin@mail.com'    ,
            'password'   => Hash::make('123456'),
            'scope'      => 'crud-list'         ,
            'created_at' => Carbon::now()       ,
            'updated_at' => Carbon::now()       ,
        ]);
    }
}
