<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateINVReceiptDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('INV_Receipt_Details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detail');
            $table->string('date');
            $table->mediumInteger('price');
            $table->string('note');
            $table->string('address');
            $table->timestamps();
            $table->unsignedBigInteger('Receipt_lists_id');
            $table->foreign('Receipt_lists_id')->references('id')->on('INV_Receipt_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('INV_Receipt_Details');
    }
}