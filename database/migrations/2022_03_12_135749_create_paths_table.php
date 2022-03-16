<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paths', function (Blueprint $table) {
            $table->id();
            $table->string('path')->nullable();
            $table->string('type')->nullable();
            $table->string('summary')->nullable();
            $table->string('description')->nullable();
            $table->string('operationId')->nullable();
            $table->json('consumes')->nullable();      
            $table->json('produces')->nullable();      
            $table->json('tags')->nullable();
            $table->json('parameters')->nullable();
            $table->json('responses')->nullable();
            $table->json('security')->nullable();
            $table->json('requestBody')->nullable();
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
        Schema::dropIfExists('paths');
    }
}
