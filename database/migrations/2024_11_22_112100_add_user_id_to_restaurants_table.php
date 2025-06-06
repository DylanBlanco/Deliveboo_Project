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
        Schema::disableForeignKeyConstraints();
        Schema::enableForeignKeyConstraints();
        // Relazione One to One tra users e restaurants
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurant_id')->nullable(); // Chiave esterna
        
            $table->foreign('restaurant_id') // Relazione inversa
                ->references('id')         // Colonna nella tabella `restaurants`
                ->on('restaurants')        // Tabella di riferimento
                // ->after('')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropForeign(['restaurant_id']);
            $table->dropColumn('restaurant_id');
        });
    }
};
