<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrearUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'logan';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin');
        $user->timestamps = now();
        $user->subscription_id = 4;
        $user->stripe_subscription_id = 'sub_1Q2345678901234567890123';
        $user->save();

        $user2 = new User();
        $user2->name = 'admin';
        $user2->email = 'admin2@admin.com';
        $user2->password = bcrypt('admin');
        $user2->subscription_id = 4;
        $user2->stripe_subscription_id = 'sub_1Q2345678901234567890123';
        $user2->timestamps = now();
        $user2->save();

        $user3 = new User();
        $user3->name = 'paco';
        $user3->email = 'paco@paco.com';
        $user3->password = bcrypt('admin');
        $user3->subscription_id = 4;
        $user3->stripe_subscription_id = 'sub_1Q2345678901234567890123';
        $user3->timestamps = now();
        $user3->save();
    }
}
