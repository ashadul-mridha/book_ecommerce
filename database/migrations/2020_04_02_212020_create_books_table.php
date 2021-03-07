<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('author_id')->unsigned();
            $table->bigInteger('publisher_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('search_title')->nullable();
            $table->integer('price');
            $table->integer('discount')->nullable();
            $table->longText('description')->nullable();
            $table->string('photo')->default('book.png');
            $table->integer('quantity');
            $table->string('edition');
            $table->string('language');
            $table->string('status')->default(1);
            $table->integer('view_count')->default(0);
            $table->integer('love_count')->default(0);
            $table->integer('best_sale')->default(0)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
