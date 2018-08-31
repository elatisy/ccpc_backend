<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->increments('cid');
            $table->string('type');
            $table->string('title');
            $table->string('previewImg');
            $table->longText('text');
            $table->integer('authorId');
            $table->string('status');
            $table->string('details')->nullable();
            $table->string('competeType')->nullable();
            $table->string('competePlace')->nullable();
            $table->string('competeTime')->nullable();
            $table->integer('created_at');
            $table->integer('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content');
    }
}
