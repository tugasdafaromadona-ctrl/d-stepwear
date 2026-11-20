<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin untuk login ke /login
        User::updateOrCreate(
            ['email' => 'admin@dstepwear.test'],
            ['name' => 'Admin D Stepwear', 'password' => Hash::make('password')]
        );

        $categories = collect([
            'Sneakers' => 'Sepatu santai untuk aktivitas harian dan nongkrong.',
            'Sepatu Olahraga' => 'Ringan dan empuk untuk lari, futsal, dan latihan.',
            'Sandal' => 'Sandal nyaman untuk di rumah maupun bepergian.',
            'Sepatu Formal' => 'Sepatu kerja dan acara resmi dengan tampilan rapi.',
        ])->map(fn ($desc, $name) => Category::firstOrCreate(['name' => $name], ['description' => $desc]));

        $products = [
            ['Sneakers', 'Stepwear Runner Pro', 389000, 24, true, 'Sneakers dengan sol EVA empuk dan bagian atas mesh yang adem. Cocok dipakai seharian ke kampus maupun kantor.'],
            ['Sneakers', 'Urban Street Low', 299000, 31, true, 'Siluet low-top bersih dengan kombinasi warna netral yang mudah dipadukan dengan outfit apa pun.'],
            ['Sneakers', 'Daily Knit Sneakers', 329000, 18, false, 'Upper rajut elastis yang menyesuaikan bentuk kaki. Ringan dan tidak bikin gerah.'],
            ['Sepatu Olahraga', 'Sprint Max Trainer', 459000, 15, true, 'Sepatu latihan dengan bantalan tumit ekstra dan outsole anti-slip untuk lari dan gym.'],
            ['Sepatu Olahraga', 'Court Flex Basket', 425000, 12, false, 'Pegangan kuat di lapangan indoor, dengan penyangga pergelangan kaki yang stabil.'],
            ['Sandal', 'Aero Slide Sandal', 149000, 40, true, 'Sandal slide berbahan ringan dan cepat kering. Nyaman untuk harian di rumah.'],
            ['Sandal', 'Trail Strap Sandal', 189000, 22, false, 'Sandal dengan strap adjustable dan sol bergerigi untuk jalan santai di luar ruangan.'],
            ['Sepatu Formal', 'Classic Derby Hitam', 459000, 10, false, 'Derby kulit sintetis dengan jahitan rapi dan sol karet yang tidak licin.'],
            ['Sepatu Formal', 'Loafer Casual Coklat', 379000, 14, false, 'Loafer slip-on untuk kantor santai atau acara semi formal.'],
        ];

        foreach ($products as [$category, $name, $price, $stock, $featured, $description]) {
            Product::updateOrCreate(
                ['name' => $name],
                [
                    'category_id' => $categories[$category]->id,
                    'price' => $price,
                    'stock' => $stock,
                    'is_featured' => $featured,
                    'description' => $description,
                ]
            );
        }
    }
}
