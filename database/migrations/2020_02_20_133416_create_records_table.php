<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->float('amount', 10,2);
            $table->enum('type', ['CREDIT', 'DEBIT']);
            $table->timestamp('date');
            $table->string('description', 255);
            $table->string('tags', 255)->nullable();
            $table->string('note', 255)->nullable();
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record');
    }
}
