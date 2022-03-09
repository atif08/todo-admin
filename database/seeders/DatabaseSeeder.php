<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $roles=['super-admin','user'];
        foreach ($roles as $role){
            if(!Role::where('name',$role)->first()){
                Role::create(
                    [
                        'name'=>$role,
                        'guard_name'=>'web'
                    ]
                );
            }
        }
        if(!User::where('type',1)->first()){
          $user=  User::create([
                'name'=>'admin',
                'email'=>'admin@admin.com',
                'password'=>Hash::make('admin@123'),
                'status'=>1,
                'type'=>1,
            ]);
            $user->assignRole('super-admin');
        }
        if(!User::where('email','test@gmail.com')->first()){
            $user=  User::create([
                'name'=>'todo',
                'email'=>'test@gmail.com',
                'password'=>Hash::make('12345678'),
                'status'=>1,
                'type'=>2,
            ]);
            $user->assignRole('user');
        }
    }
}
