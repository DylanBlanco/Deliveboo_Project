<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('categories_restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id') // inserisce la colonna della chiave esterna
                ->constrained('categories') //crea la connessione con la tabella categories
                ->onDelete('cascade'); //cancellare i piatti se la tabella categories viene eliminata
            $table->foreignId('restaurant_id') // inserisce la colonna della chiave esterna
                ->constrained('restaurants') //crea la connessione con la tabella restaurants
                ->onDelete('cascade'); //cancellare i piatti se la tabella restaurants viene eliminata
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('categories_restaurants')) {
            Schema::table('categories_restaurants', function (Blueprint $table) {
                if (Schema::hasColumn('categories_restaurants', 'category_id')) {
                    $table->dropForeign(['category_id']);
                }
                if (Schema::hasColumn('categories_restaurants', 'restaurant_id')) {
                    $table->dropForeign(['restaurant_id']);
                }
            });

            Schema::dropIfExists('categories_restaurants');
        }
    }


};
