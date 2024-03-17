<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categories>
 */
class CategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Minuman', 'Makanan', 'Perkakas', 'Elektronik', 'Kendaraan',
                'Pakaian', 'Peralatan Rumah Tangga', 'Kebutuhan Bayi', 'Kosmetik',
                'Obat-obatan', 'Produk Pertanian', 'Produk Peternakan',
                'Produk Pertanian Organik', 'Produk Peternakan Organik',
                'Produk Kesehatan', 'Produk Kebersihan', 'Produk Pembersih',
                'Produk Pertahanan', 'Produk Pertahanan Organik', 'Produk Alat Olahraga'
            ]),
            'users_id' => 1,
        ];
    }
}
