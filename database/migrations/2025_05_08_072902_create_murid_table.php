<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('murid', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis');
            $table->string('no_telp');
            $table->string('jenis_kelamin');
            $table->string('tgl_lahir');
            $table->enum('avatar', ['img/avt/avt0.png', 'img/avt/avt1.png', 'img/avt/avt2.png', 'img/avt/avt3.png', 'img/avt/avt4.png'])->default('img/avt/avt0.png');
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'murid_user_id'
            );
            $table->foreignId('kelas_id')->constrained(
                table: 'kelas', indexName: 'murid_kelas_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('murid');
    }
};
