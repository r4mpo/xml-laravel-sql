<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercadorias', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_categoria_2')->nullable();
            $table->foreign('fk_categoria_2')->references('id')->on('categorias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mercadorias', function (Blueprint $table) {
            $table->dropColumn('fk_categoria_2');
        });
    }
};
