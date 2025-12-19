<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // This connects to your Product model

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // This adds your 4 featured phones to the database
        Product::create([
            'name' => 'Apple iPhone 16',
            'price' => 135299,
            'image' => 'https://hukut.com/_next/image?url=https%3A%2F%2Fcdn.hukut.com%2Fapple-iphone-16-ultramarine.webp1728295065216&w=640&q=75',
            'ram' => '8GB',
            'storage' => '128GB',
            'description' => 'The latest Apple flagship with advanced camera system.'
        ]);

        Product::create([
            'name' => 'Samsung Galaxy S25 Ultra',
            'price' => 179999,
            'image' => 'https://hukut.com/_next/image?url=https%3A%2F%2Fcdn.hukut.com%2FSamsung-Z-Flip-6-Silver-Shadow-1-595xh.png1721189624833&w=640&q=75',
            'ram' => '12GB',
            'storage' => '256GB',
            'description' => 'Unmatched performance with Galaxy AI.'
        ]);

        Product::create([
            'name' => 'Xiaomi 14T',
            'price' => 64999,
            'image' => 'https://hukut.com/_next/image?url=https%3A%2F%2Fcdn.hukut.com%2Fxiaomi-14t-titan-gray.png1739784095884&w=1200&q=75',
            'ram' => '12GB',
            'storage' => '256GB',
            'description' => 'High-end specs at an incredible value.'
        ]);

        Product::create([
            'name' => 'Vivo X300 Pro',
            'price' => 179999,
            'image' => 'https://hukut.com/_next/image?url=https%3A%2F%2Fcdn.hukut.com%2Fvivo-x300-pro-dune-brown.webp1765248239480&w=640&q=75',
            'ram' => '16GB',
            'storage' => '512GB',
            'description' => 'Professional-grade photography in a mobile.'
        ]);
    }
}