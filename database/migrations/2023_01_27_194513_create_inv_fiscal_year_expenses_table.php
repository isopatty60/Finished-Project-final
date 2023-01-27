<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvFiscalYearExpensesTable extends Migration
{

    public function up()
    {
        Schema::create('inv_fiscal_year_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inv_fiscal_year_expenses');
    }
}