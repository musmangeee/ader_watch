<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('ad_id')->nullable();
            $table->string('stars')->nullable();
            $table->text('text')->nullable();
            $table->string('cool')->nullable();
            $table->string('funny')->nullable();
            $table->string('useful')->nullable();
            $table->string('reported')->nullable();
            $table->string('checked_in')->nullable();
            $table->string('compliment')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}
