<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Helper\Table;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MedJudic', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('NumProcJud');
            $table->string('Vara');
            $table->string('SecJud');
            $table->string('SubSecJud');
            $table->string('dtConcessao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MedJudic');
    }
};