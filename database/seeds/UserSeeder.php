<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->userCreate();
    }

    public function userCreate(){
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin');
        $user->role = 'admin';
        $user->save();

        $user = new User;
        $user->name = 'User';
        $user->email = 'user@user.com';
        $user->password = bcrypt('user');
        $user->role = 'user';
        $user->save();
    }
}
