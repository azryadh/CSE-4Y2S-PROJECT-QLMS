<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassWorksAnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_works_ans', function (Blueprint $table) {
            $table->id();
            $table->longText('answers');
            $table->integer('users_id');
            $table->integer('courses_id');
            $table->integer('flag')->default(0);
            $table->integer('class_works_id');
            $table->string('evaluations')->nullable();
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
        Schema::dropIfExists('class_works_ans');
    }
}
