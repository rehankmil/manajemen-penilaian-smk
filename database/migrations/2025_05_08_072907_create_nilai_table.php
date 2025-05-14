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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai');
            $table->string('predikat');
            $table->string('semester');
            $table->foreignId('mapel_id')->constrained(
                table: 'mapels', indexName: 'nilai_mapel_id'
            );
            $table->foreignId('guru_id')->constrained(
                table: 'gurus', indexName: 'nilai_gurus_id'
            );
            $table->foreignId('murid_id')->constrained(
                table: 'murid', indexName: 'nilai_murid_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
