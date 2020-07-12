<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCompsBooksWriters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comps_books_writers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_book');
            $table->bigInteger('id_writer');
            $table->bigInteger('id_pub');
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
        Schema::dropIfExists('comps_books_writers');
    }
}
