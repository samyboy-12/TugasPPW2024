<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Book::create([
                'judul' => fake()->sentence(nbWords: 3),
                'penulis' => fake()->name(),
                'harga' => fake()->numberBetween(int1: 10000, int2: 50000),
                'tgl_terbit' => fake()->date(),
            ]);
        }
    }
}