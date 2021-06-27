<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table
                ->string('name')
                ->unique()
                ->index();
            $table->string('original_name');
            $table->string('extension', 12);
            $table->integer('size')->unsigned();
            $table->string('hash_md5', 32);
            $table->string('hash_sha1', 40);
            $table->timestamps();

            $table->unique(['user_id', 'name']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
}
