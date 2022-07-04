<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'Juan Carlos Ruiz Garcia','email' => 'jcruizg14@misena.edu.co','password' => bcrypt('junior18')]);
        User::create(['name' => 'Hugo','email' => 'hugo@gmail.com','password' => bcrypt('hugo')]);
        User::create(['name' => 'Karen','email' => 'karen@gmail.com','password' => bcrypt('karen')]);
    }
}
