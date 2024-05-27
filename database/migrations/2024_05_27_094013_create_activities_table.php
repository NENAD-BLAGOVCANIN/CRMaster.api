<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('module_id')->nullable();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('set null');

            $table->unsignedBigInteger('submodule_id')->nullable();
            $table->foreign('submodule_id')->references('id')->on('submodules')->onDelete('set null');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            
            $table->string('title');
            $table->text('comments')->nullable();

            $table->string('value');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
