<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create([
            'name' => 'Mark bee Umii',
            'email' => 'markbee@gmail.com',
            'password'=> '123456'
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call([
        //     CategorySeeder::class,
        //     PostSeeder::class,
        // ]);
        // Post::factory(5)
        //         ->count(5)
        //         ->hasCategory(5)
        //         ->hasUser(5)
        //         ->create();
    }
}
