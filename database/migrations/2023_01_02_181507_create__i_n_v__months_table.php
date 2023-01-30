<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateINVMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('INV_Months', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detail');
            $table->date('date');
            $table->timestamps();
            $table->unsignedBigInteger('Fiscal_year_id');
            $table->foreign('Fiscal_year_id')->references('id')->on('INV_Fiscal_years')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('INV_Months');
    }
}
