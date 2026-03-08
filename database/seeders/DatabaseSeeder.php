<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Muhammad HIdayatullah',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        $this->call([
            RolePermissionSeeder::class,
            QuestionSeeder::class,
            SignerSeeder::class,
        ]);

        $user->assignRole('admin');
    }
}
