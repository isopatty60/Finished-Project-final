<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvMonthExpensesTable extends Migration
{
    public function up()
    {
        Schema::create('inv_month_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detail');
            $table->date('date');
            $table->timestamps();
            $table->unsignedBigInteger('fiscal_year_id_expenses');
            $table->foreign('fiscal_year_id_expenses')->references('id')->on('inv_fiscal_year_expenses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inv_month_expenses');
    }
}
