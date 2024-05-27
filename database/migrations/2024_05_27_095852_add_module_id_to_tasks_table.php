<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('module_id')->nullable()->after('id');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('set null');

            $table->unsignedBigInteger('submodule_id')->nullable()->after('module_id');
            $table->foreign('submodule_id')->references('id')->on('submodules')->onDelete('set null');
        });
    }


    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['module_id']);
            $table->dropColumn('module_id');

            $table->dropForeign(['submodule_id']);
            $table->dropColumn('submodule_id');
        });
    }
};
