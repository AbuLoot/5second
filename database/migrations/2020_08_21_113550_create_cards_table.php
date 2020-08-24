<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sort_id')->nullable();
            $table->string('slug');
            $table->string('title');
            $table->string('image')->nullable();
            $table->integer('price');
            $table->integer('user_number');
            $table->integer('service_number');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('content')->nullable();
            $table->char('lang', 4);
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::create('privileges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('card_id')->references('id')->on('cards');
            $table->string('gov_number');
            $table->enum('card_type', ['silver', 'gold', 'platinum']);
            $table->string('barcode')->nullable();
            $table->string('services')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('cards');
    }
}
