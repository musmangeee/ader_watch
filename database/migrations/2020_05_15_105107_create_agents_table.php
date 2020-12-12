<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullabel();
            $table->string('email')->unique();
            $table->string('password')->nullabel();
            $table->string('zipcode')->nullabel();
            $table->string('month')->nullabel();
            $table->string('day')->nullabel();
            $table->string('year')->nullabel();
            $table->string('status')->default(1);
            $table->string('image')->nullabel();
            $table->rememberToken();
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
        Schema::dropIfExists('agents');
    }
}
