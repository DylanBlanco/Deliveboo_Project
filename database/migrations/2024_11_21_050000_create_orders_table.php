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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('telephone');
            $table->string('email');
            $table->decimal('total_price', 8, 2);
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('orders');
        Schema::enableForeignKeyConstraints();

    }
};
