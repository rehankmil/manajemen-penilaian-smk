<?php

namespace App\Models;

use App\Models\Mapel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $fillable = ['kode'];

    public function murid(): HasMany
    {
        return $this->HasMany(Murid::class, 'kelas_id');
    }
}
