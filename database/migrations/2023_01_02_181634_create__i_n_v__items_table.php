<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateINVItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('INV_Items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detail');
            $table->date('date');
            $table->string('note');
            $table->DECIMAL('price');
            $table->string('image_product');
            $table->timestamps();
            $table->unsignedBigInteger('detail_id');
            $table->foreign('detail_id')->references('id')->on('INV_Details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('INV_Items');
    }
}
