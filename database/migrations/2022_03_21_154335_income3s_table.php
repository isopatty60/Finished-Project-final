<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Income3sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income3s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detail');
            $table->string('date');
            $table->string('note');
            $table->DECIMAL('price');
            $table->string('image_product');
            $table->timestamps();
            $table->unsignedBigInteger('id_income03_lists');
            $table->foreign('id_income03_lists')->references('id')->on('income2s')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income3s');
    }
}

