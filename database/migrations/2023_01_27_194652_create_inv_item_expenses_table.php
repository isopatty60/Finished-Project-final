<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvItemExpensesTable extends Migration
{
    public function up()
    {
        Schema::create('inv_item_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detail');
            $table->date('date');
            $table->string('note');
            $table->DECIMAL('price');
            $table->string('image_product');
            $table->timestamps();
            $table->unsignedBigInteger('detail_expenses_id');
            $table->foreign('detail_expenses_id')->references('id')->on('inv_detail_expenses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inv_item_expenses');
    }
}
