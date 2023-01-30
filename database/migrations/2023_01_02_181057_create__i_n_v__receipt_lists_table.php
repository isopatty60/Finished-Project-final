<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateINVReceiptListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('INV_Receipt_lists', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('address');
            $table->date('date');
            $table->int('tel');
            $table->int('postcode');
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
        Schema::dropIfExists('INV_Receipt_lists');
    }
}
