<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Disabilita i vincoli di chiave esterna
        Schema::disableForeignKeyConstraints();

        // Trunca la tabella
        Category::truncate();

        // Ripristina i vincoli di chiave esterna
        Schema::enableForeignKeyConstraints();

        // Inserisci i dati
        $categories = [
            ['name' => 'Italiano'],
            ['name' => 'Giapponese'],
            ['name' => 'Messicano'],
            ['name' => 'Cinese'],
            ['name' => 'Indiano'],
            ['name' => 'Francese'],
        ];

        Category::insert($categories);

    }
}