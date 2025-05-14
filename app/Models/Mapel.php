<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapels';
    protected $primaryKey = 'id';
    protected $fillable = ['kode', 'nama'];

    public function guru(): HasMany
    {
        return $this->HasMany(Guru::class, 'mapel_id');
    }

    public function nilai(): HasMany
    {
        return $this->HasMany(Nilai::class, 'mapel_id');
    }
}