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
        Schema::create('flight', function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->string('name')->charset('utf8mb4');
            $table->string('location_start')->charset('utf8mb4');
            $table->dateTime('time_start');
            $table->string('location_end')->charset('utf8mb4');
            $table->string('type_way')->charset('utf8mb4');
            $table->decimal('price');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
