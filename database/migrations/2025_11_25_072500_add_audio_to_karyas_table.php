<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('karyas', function (Blueprint $table) {
            $table->string('audio')->nullable()->after('gambar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('karyas', function (Blueprint $table) {
            $table->dropColumn('audio');
        });
    }
};
