<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productdatas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('detail');
            $table->string('date');
            $table->unsignedBigInteger('id_productdatas');
            $table->foreign('id_productdatas')->references('id')->on('products')->onDelete('cascade');

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
        Schema::dropIfExists('productdatas');
    }
}
