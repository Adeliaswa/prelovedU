<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Jaket Denim Preloved',
            'price' => 75000,
            'description' => 'Jaket denim bekas layak pakai, kondisi 85%.',
            'stock' => 5,
        ]);

        Product::create([
            'name' => 'Buku Algoritma',
            'price' => 45000,
            'description' => 'Buku algoritma bekas mahasiswa, masih lengkap.',
            'stock' => 3,
        ]);

        Product::create([
            'name' => 'Sepatu Sneakers',
            'price' => 120000,
            'description' => 'Sneakers preloved ukuran 42.',
            'stock' => 2,
        ]);
    }
}