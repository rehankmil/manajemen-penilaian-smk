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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('email')->unique();
            $table->string('no_telp');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tgl_lahir');
            $table->enum('avatar', ['img/avt/avt0.png', 'img/avt/avt1.png', 'img/avt/avt2.png', 'img/avt/avt3.png', 'img/avt/avt4.png'])->default('img/avt/avt0.png');
            $table->foreignId('mapel_id')->constrained(
                table: 'mapels', indexName: 'gurus_mapel_id'
            );
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'gurus_user_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
