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
        Schema::table('subjects', function (Blueprint $table) {
            // Drop the existing foreign key and column
            $table->dropForeign(['teacher_id']);
            $table->dropColumn('teacher_id');

            // Add the new foreign key and column
            $table->unsignedBigInteger('schedule_id')->after('name');

            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            // Drop the new foreign key and column
            $table->dropForeign(['schedule_id']);
            $table->dropColumn('schedule_id');

            // Restore the old foreign key and column
            $table->unsignedBigInteger('teacher_id')->after('name');

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }
};
