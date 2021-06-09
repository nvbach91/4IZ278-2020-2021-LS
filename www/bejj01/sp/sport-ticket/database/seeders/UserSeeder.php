<?php


namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    public function run() {
        User::truncate();

        // Create default admin account
        User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$12$Jjv19z2shR0svxeRiSp2wOyebf5Y1IUYm0JEqBp0qRk.Lc6zFrduC',
            'is_admin' => true
        ]);
    }
}
