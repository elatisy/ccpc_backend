<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->increments('cid');

            $table->string('title');
            $table->string('year', 10);
            $table->string('school');
            $table->string('date');
            $table->longText('carousel1')->nullable();      //用|分割url和文字
            $table->longText('carousel2')->nullable();
            $table->longText('carousel3')->nullable();
            $table->string('invitation')->nullable();       //邀请函
            $table->string('schedule')->nullable();         //日程安排
            $table->string('award_list')->nullable();       //奖项榜单
            $table->longText('info1')->nullable();          //用|分割日期和具体内容
            $table->longText('info2')->nullable();
            $table->longText('info3')->nullable();
            $table->string('intro_background')->nullable();
            $table->longText('service1')->nullable();
            $table->longText('service2')->nullable();
            $table->longText('service3')->nullable();       //用|分割标题和具体内容
            $table->string('service_image1');
            $table->string('service_image2');
            $table->string('service_image3');
            $table->longText('tree_new_bee_text')->nullable();
            $table->string('tree_new_bee_background')->nullable();
            $table->integer('stat1')->nullable();
            $table->integer('stat2')->nullable();
            $table->integer('stat3')->nullable();
            $table->string('famous')->nullable();           //用|分割url
            $table->string('famous_text')->nullable();      //用|分割正文标题

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
        Schema::dropIfExists('contests');
    }
}
