<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToDishesTable extends Migration
{
    public function up()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->softDeletes(); // Aggiunge il campo 'deleted_at'
        });
    }

    public function down()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Rimuove il campo 'deleted_at'
        });
    }
}
