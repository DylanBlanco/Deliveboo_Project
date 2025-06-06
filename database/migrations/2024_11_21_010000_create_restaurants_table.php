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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable(); // Chiave esterna

            $table->foreign('user_id') // Definizione della relazione
                  ->references('id')   // Colonna nella tabella `users`
                  ->on('users')        // Nome della tabella di riferimento
                  ->onDelete('cascade'); // Comportamento in caso di eliminazione

            $table->string('name');
            $table->string('address');
            $table->string('partita_iva');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('dishes')) {
            Schema::table('dishes', function (Blueprint $table) {
                $table->dropForeign(['restaurant_id']);
            });
        }

        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropForeign(['restaurant_id']);
            });
        }

        Schema::dropIfExists('restaurants');
    }



};
