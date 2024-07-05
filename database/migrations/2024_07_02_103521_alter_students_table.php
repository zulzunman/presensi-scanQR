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
        Schema::table('students', function (Blueprint $table) {
            // Menambah kolom baru
            $table->string('nis')->after('id');
            $table->enum('jenis_kelamin', ['Laki - Laki', 'Perempuan'])->after('name');
            $table->unsignedBigInteger('class_id')->after('jenis_kelamin');

            // Menghapus kolom 'class'
            $table->dropColumn('class');

            // Menambahkan foreign key untuk 'class_id'
            $table->foreign('class_id')->references('id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Mengembalikan perubahan
            $table->dropForeign(['class_id']);
            $table->dropColumn(['nis', 'jenis_kelamin', 'class_id']);
            $table->string('class')->after('name');
        });
    }
};
