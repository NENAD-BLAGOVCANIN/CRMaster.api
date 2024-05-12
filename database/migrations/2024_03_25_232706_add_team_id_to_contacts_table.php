<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {

            $table->unsignedBigInteger('business_id')->nullable();
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('set null');

        });
    }


    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            
            $table->dropForeign(['business_id']);
            $table->dropColumn('business_id');

        });
    }
};
