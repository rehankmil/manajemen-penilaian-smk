<?php

namespace App\Models;

use App\Models\Mapel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';
    protected $primaryKey = 'id';
    protected $fillable = ['nip', 'email', 'nama', 'no_telp', 'jenis_kelamin', 'tgl_lahir', 'avatar', 'mapel_id', 'user_id'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }
    

    public function nilai(): HasMany
    {
        return $this->HasMany(Nilai::class, 'guru_id');
    }
}