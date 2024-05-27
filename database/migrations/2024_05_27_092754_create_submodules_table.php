<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('submodules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('module_id')->nullable();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('set null');

            $table->string('name');
            $table->text('comments')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('submodules');
    }
};
