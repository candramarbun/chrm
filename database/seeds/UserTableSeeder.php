<?php

use Illuminate\Database\Seeder;
use App\Role;
Use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name','user')->first();
    	$role_author = Role::where('name','author')->first();
    	$role_admin = Role::where('name','admin')->first();
        $user = new User;
        $user->first_name = 'Candra';
        $user->last_name ='User';
        $user->email ='user@gmail.com';
        $user->password =bcrypt('123456');
        $user->save();
        $user->roles()->attach($role_user);

        $author = new User;
        $author->first_name = 'Candra';
        $author->last_name ='Author';
        $author->email ='author@gmail.com';
        $author->password =bcrypt('123456');
        $author->save();
        $author->roles()->attach($role_author);

        $admin = new User;
        $admin->first_name = 'Candra';
        $admin->last_name ='Admin';
        $admin->email ='admin@gmail.com';
        $admin->password =bcrypt('123456');
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
