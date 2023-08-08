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
        Schema::create('airplane', function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->string('airplane_name');
            $table->string('airplane_code');
            $table->string('airplane_brand_id');
            $table->integer('qty_seat');
            $table->string('about')->charset('utf8mb4');
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
