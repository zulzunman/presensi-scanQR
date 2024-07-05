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
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('nip')->after('name');
            $table->enum('jenis_kelamin', ['Laki - Laki', 'Perempuan'])->after('nip');
            $table->unsignedBigInteger('subject_id')->nullable()->after('jenis_kelamin');

            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropColumn(['nip', 'jenis_kelamin', 'subject_id']);
        });
    }
};
