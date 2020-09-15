<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('categorys', function (Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->string('slug'); //link danh mục cho mục đích seo
            $table->string('image');
            $table->text('desc');
            $table->integer('parent_id')->default(0);
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
