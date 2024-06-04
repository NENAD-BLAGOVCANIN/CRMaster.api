<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('business_users', function (Blueprint $table) {
            $table->unsignedBigInteger('business_role_id')->nullable();
            $table->foreign('business_role_id')->references('id')->on('business_roles')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('business_users', function (Blueprint $table) {
            $table->dropForeign(['business_role_id']);
            $table->dropColumn('business_role_id');
        });
    }
};
