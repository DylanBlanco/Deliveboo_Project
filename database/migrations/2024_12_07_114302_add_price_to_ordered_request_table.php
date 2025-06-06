<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ordered_request', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->nullable(); // Aggiungi la colonna price
        });
    }

    public function down()
    {
        Schema::table('ordered_request', function (Blueprint $table) {
            $table->dropColumn('price'); // Rimuovi la colonna price nel caso di rollback
        });
    }

};
