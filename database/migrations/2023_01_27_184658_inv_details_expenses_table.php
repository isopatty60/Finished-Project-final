<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvDetailsExpensesTable extends Migration
{
    public function up()
    {
        Schema::create('inv_detail_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detail');
            $table->string('date');
            $table->DECIMAL('price');
            $table->string('note');
            $table->timestamps();
            $table->unsignedBigInteger('month_expenses_id');
            $table->foreign('month_expenses_id')->references('id')->on('inv_month_expenses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inv_detail_expenses');
    }
}