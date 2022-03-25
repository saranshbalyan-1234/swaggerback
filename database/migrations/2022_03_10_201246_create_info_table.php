<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable();
            $table->string('version')->nullable();
            $table->string('title')->nullable();
            $table->string('host')->nullable();
            $table->string('basePath')->nullable();
            $table->string('schemes')->nullable();
            $table->foreignId('project_id');
            $table->foreign('project_id')
            ->references('id')->on('projects'); 
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
        Schema::dropIfExists('info');
    }
}
