<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';
    protected $primaryKey = 'id';
    protected $fillable = ['nilai', 'predikat', 'semester', 'mapel_id', 'guru_id', 'murid_id'];

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
    
    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
    
    public function murid(): BelongsTo
    {
        return $this->belongsTo(Murid::class, 'murid_id');
    }
}