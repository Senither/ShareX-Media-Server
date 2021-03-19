<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table
                ->string('name')
                ->unique()
                ->index();
            $table->string('extension', 12);
            $table->timestamps();

            $table->unique(['user_id', 'name']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
}
