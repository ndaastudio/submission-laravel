<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $isGenerateUid = false;
        while (!$isGenerateUid) {
            $uid = Str::random(10);
            $isExist = User::where('uid', $uid)->first();
            if (!$isExist) {
                $isGenerateUid = true;
            }
        }
        User::create([
            'uid' => $uid,
            'nama' => 'Nda',
            'email' => 'nda@gmail.com',
            'password' => bcrypt('nda12345'),
            'role' => 2
        ]);

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'nama_kategori' => ucwords($faker->unique()->word()),
            ]);
            Tag::create([
                'nama_tag' => ucwords($faker->unique()->word()),
            ]);
        }
    }
}
