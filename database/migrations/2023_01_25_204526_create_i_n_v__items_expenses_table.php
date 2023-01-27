<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateINVItemsExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('INV_items_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detail');
            $table->string('date');
            $table->string('note');
            $table->DECIMAL('price');
            $table->string('image_product');
            $table->timestamps();
            $table->unsignedBigInteger('detail_expenses_id');
            $table->foreign('detail_expenses_id')->references('id')->on('INV_details_expenses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('INV_items_expenses');
    }
}