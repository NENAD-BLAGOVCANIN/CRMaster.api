<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubmoduleTemplatesTable extends Migration
{
    public function up(): void
    {
        Schema::create('submodule_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('submodule_templates');
    }
};
