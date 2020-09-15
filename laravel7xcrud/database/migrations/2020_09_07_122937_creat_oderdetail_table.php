<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatOderdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('oderdetail', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->decimal('product_price');
            $table->integer('quantity');
            $table->integer('oder_id');
            $table->integer('oder_status');
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
        //
    }
}
