<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::insert([
            [
                'name' => 'Crypto',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Technologies',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
