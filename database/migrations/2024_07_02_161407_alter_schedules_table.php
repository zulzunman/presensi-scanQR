<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Drop the existing foreign key and column
            $table->dropColumn('class');
            $table->unsignedBigInteger('class_id');

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Mengembalikan perubahan
            $table->dropForeign(['class_id']);
            $table->dropColumn(['class_id']);
            $table->string('class');
        });
    }
};
